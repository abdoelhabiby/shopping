<?php

namespace App\Http\Services;

use DateTime;
use Exception;
use DateTimeZone;
use App\Cart\Cart;
use App\Models\Order;
use Illuminate\Support\Str;
use App\Models\OrderProduct;
use Cartalyst\Stripe\Stripe;
use App\Models\UserAddressDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;


class MyfatoorahPaymentService
{



    private static function newStripe()
    {
        return new Stripe(env('STRIPE_SECRET_KEY'));
    }


    public static function cart()
    {
        if (session()->has('cart')) {

            $cart = new Cart(session('cart'));
        } else {
            $cart = new Cart();
        }

        return $cart;
    }


    public static function getApiKey()
    {
        return env('MAYFATOORAH_API_TOKEN');
    }


    public static function getApiUrl()
    {
        return env('MAYFATOORAH_BASE_URL');
    }



    public static function init($total_price) : array
    {


        //-------expire date---------------------------------
        $tz = 'Asia/Kuwait';
        $timestamp = time() + 60 * 10; // expire after 10 minut from now
        $dt = new DateTime('now', new DateTimeZone($tz)); //first argument "must" be a string
        $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
        $expiry_date =  $dt->format('Y-m-d\TH:i:s');

        // --------------------get link payment---------------

        $postFields = [
            //Fill required data
            'NotificationOption' => 'Lnk', //'SMS', 'EML', or 'ALL'
            'InvoiceValue'       => $total_price,

            //Fill optional data
            'DisplayCurrencyIso' => 'EGP',
            'DisplayCountryIso' => 'EGY',
            'CallBackUrl'        => env('MAYFATOORAH_CALLBACK_SUCCESS'),
            // 'ErrorUrl'           => env('MAYFATOORAH_CALLBACK_ERROR'), //or 'https://example.com/error.php'
            //'Language'           => 'en', //or 'ar'
            //'CustomerReference'  => 'orderId',
            //'CustomerCivilId'    => 'CivilId',
            //'UserDefinedField'   => 'This could be string, number, or array',
            //'ExpiryDate'         => '', //The Invoice expires after 3 days by default. Use 'Y-m-d\TH:i:s' format in the 'Asia/Kuwait' time zone.
            'ExpiryDate'         => $expiry_date,
            //'SourceInfo'         => 'Pure PHP', //For example: (Laravel/Yii API Ver2.0 integration)

        ];

        $postFields = array_merge(self::getUserAddressDetails(user()->addressdetails), $postFields);

        //Call endpoint
        $data = self::sendPayment(self::getApiUrl(), self::getApiKey(), $postFields);

        //  dd($data);
        //You can save payment data in database as per your needs

        $invoiceId   = $data->InvoiceId;
        $paymentLink = $data->InvoiceURL;


        // -------------------------------------------

      return  $data = [
            'payment_link' => $paymentLink,
            'invoice_id' => $invoiceId
        ];




    }

    // --------------------------------------------------------
    //-------------------------------------------------------
    public static function  sendPayment($apiURL, $apiKey, $postFields)
    {
        $json = self::callAPI("$apiURL/v2/SendPayment", $apiKey, $postFields);
        return $json;
    }


    //-------------------------------------------------------

    private static function callAPI($endpointURL, $apiKey, $postFields = [], $requestType = 'POST')
    {


        $response = Http::withToken($apiKey)
            ->accept('application/json')
            ->post($endpointURL, $postFields);



        $error = self::handleError($response);
        if ($error) {

            throw new Exception($error);
        }



        if ($response->failed()) {

            throw new Exception('call api myfatoorah get error code' . $response->status());
        }

        return json_decode($response)->Data;
    }

    //-------------------------------------------------------
    private static function handleError($response)
    {

        $json = json_decode($response);

        if (isset($json->IsSuccess) && $json->IsSuccess == true) {
            return null;
        }

        //Check for the errors
        if (isset($json->ValidationErrors) || isset($json->FieldsErrors)) {
            $errorsObj = isset($json->ValidationErrors) ? $json->ValidationErrors : $json->FieldsErrors;
            $blogDatas = array_column($errorsObj, 'Error', 'Name');

            $error = implode(', ', array_map(function ($k, $v) {
                return "$k: $v";
            }, array_keys($blogDatas), array_values($blogDatas)));
        } else if (isset($json->Data->ErrorMessage)) {
            $error = $json->Data->ErrorMessage;
        }

        if (empty($error)) {
            $error = (isset($json->Message)) ? $json->Message : (!empty($response) ? $response : 'API key or API URL is not correct');
        }

        return $error;
    }

    //-------------------------------------------------------

    public static function getPaymentData($paymentId , $key = 'paymentId')
    {



        $apiURL = self::getApiUrl();
        $apiKey = self::getApiKey();


        /* ------------------------ Call getPaymentStatus Endpoint ------------------ */
        //Inquiry using paymentId
        $keyId   = $paymentId;
        // $KeyType = 'paymentId';
        $KeyType = $key;



        //Fill POST fields array
        $postFields = [
            'Key'     => $keyId,
            'KeyType' => $KeyType
        ];
        //Call endpoint
        $json = self::callAPI("$apiURL/v2/getPaymentStatus", $apiKey, $postFields);

        return $json;

    }

    // --------------------------------------------------------


    // --------------------------------------


    protected static function getUserAddressDetails($user_address_details): array
    {


        $customerAddress = array(
            // 'Block'               => 'Blk #', //optional
            // 'Street'              => 'Str', //optional
            // 'HouseBuildingNo'     => 'Bldng #', //optional
            'Address'             => $user_address_details->address,
            'AddressInstructions' => $user_address_details->second_address ?? ''
        );

        return [
            'CustomerName'       => $user_address_details->first_name . " " . $user_address_details->last_name,
            'MobileCountryCode'  => '+20',
            'CustomerMobile'     => $user_address_details->phone,
            'CustomerEmail'      => $user_address_details->email,
            'CustomerAddress'    => $customerAddress,



        ];
    }


    // ----------------------------------
    // ----------------------------------


}
