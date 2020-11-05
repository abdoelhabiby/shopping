<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Validation\Rule;
use App\Http\Traits\HandelSlugTrait;
use Illuminate\Foundation\Http\FormRequest;

class ProductAttributeRequest extends FormRequest
{
    use HandelSlugTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {



        $rules = [
            "name" =>   "required|array|min:1|max:" . count(supportedLanguages()),
            "name.*" =>   "required|string|min:1|max:150",
            "sku" => "required|string|" . Rule::unique('product_attributes', 'sku'),
            "qty" => "required|numeric" ,
            "purchase_price" => "required|numeric" ,
            "price" => "required|numeric" ,
            "price_offer" => "sometimes|nullable|numeric",
            "start_offer_at" => "sometimes|nullable|date",
            "end_offer_at" => "sometimes|nullable|date",
            "is_active" => "sometimes|nullable",

        ];

        if (in_array($this->getMethod(), ['PUT', 'PATCH'])) {
            $rules["sku"] = "required|string|" . Rule::unique('product_attributes', 'sku')->ignore($this->product->id,'product_id');

        }


        return $rules;
    }










}
