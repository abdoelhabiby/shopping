<?php

use App\Cart\Cart;







//-------------return default no image----------

function getLinkImageNoImage(){
   echo asset('/images/noImage.jpg');
}


//--------------hundelProductReviewsStars------------

//-----------return html div stars

function hundelProductReviewsStars($stars)
{

    $stars =  $stars ?? 0;
    // $stars = (int) $stars;

    echo '<div class="star_content">';


    for ($i = 0; $i < $stars; $i++) {
        echo '<div class="star star_on"></div>';
    }
    $minus = 5 - $stars;

    if ($minus > 0) {
        for ($i = 0; $i < $minus; $i++) {
            echo ' <div class="star "></div>';
        }
    }

    echo '</div>';

    // echo "<span> $total_rating  review</span>";
}


//-----------------get count cart products----------


if (!function_exists('get_cart_products_count')) {

    function get_cart_products_count()
    {

        if (session()->has('cart')) {

            $cart = new Cart(session('cart'));
        } else {
            $cart = new Cart();
        }
        return $cart->getCountProducts();
    }
}

//------------- return limit length string------


if (!function_exists('stringLength')) {

    function stringLength(string $str, int $length)
    {

        return \Str::limit($str, $length);
    }
}


//------------- macamar ----------------

if (!function_exists('currentLocale')) {

    function currentLocale()
    {
        return LaravelLocalization::getCurrentLocale();
    }
}




/*

 ** handel the translation

*/

function nameTranslations(array $translations)
{

    $trans_content = [];

    foreach ($translations as $key => $value) {
        if (in_array($key, supportedLanguages())) {
            $trans_content[$key] = ['name' => $value];
        }
    }

    return $trans_content;
}


/*
   sidebar item is active and open
*/

function isActive($module, $number = 2)
{

    return request()->segment($number) !== null && request()->segment($number) == $module ? 'active open' : '';
}


/*
   order number of rows page pagination count
*/

function orderNumberOfRows()
{
    $start = 0;
    $page = request()->page ? (int) request()->page : 0;

    if ($page && $page > 0) {

        $start = ($page * PAGINATE_COUNT) - PAGINATE_COUNT;
    }

    return $start;
}



function localeLanguage()
{
    return \Config::get('app.locale');
}




// function imageUpload($photo, $folder_save)
// {

//     $image = $photo->store("/", $folder_save);

//     $path = "/images/" . $folder_save . "/" . $image;

//     return $path;
// }



function imageUpload($photo, $folder_save)
{
    $image = $photo->store("/" . $folder_save, 'images');
    $path = "/images/" . $image;
    return $path;
}



function deleteFile($photo_to_delet)
{
    if (\Illuminate\Support\Facades\File::exists(public_path($photo_to_delet))) {
        \Illuminate\Support\Facades\File::delete(public_path($photo_to_delet));
    }
}

//------------------------------

if (!function_exists('fileExist')) {

    function fileExist($path)
    {
        if (\Illuminate\Support\Facades\File::exists(public_path($path))) {
            return true;
        }
        return false;
    }
}


//-------------------function return pass no image


if (!function_exists('pathNoImage')) {

    function pathNoImage()
    {

        return '/images/noImage.jpg';
    }
}




function user()
{

    return auth()->user() ?? false;
}

function admin()
{

    return auth('admin')->user() ?? false;
}



function pageNameReplaceespace($name)
{
    return trim(str_replace(' ', '-', $name));
}


//----------function return catch error---------------

function catchErro($route_name, $error_catch, $message = 'some errors happend pleas try again later')
{

    \Illuminate\Support\Facades\Log::alert($error_catch);

    return redirect()->route($route_name)->with(['error' => $message]);
}


//-----------------get supported languages---------------------


function  supportedLanguages()
{
    return  Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLanguagesKeys();
}



//--------------------------function check if has has Tow image


function hasTwoImage(int $count)
{

    echo $count > 1 ? 'two-image' : '';
}
