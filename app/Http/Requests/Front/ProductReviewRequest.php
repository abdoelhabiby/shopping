<?php

namespace App\Http\Requests\Front;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductReviewRequest extends FormRequest
{
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

            'product_id' => [
                Rule::unique('product_reviews')->where(function ($query) {
                    return $query->where('user_id', user()->id);
                }),
                'required' // dosent work before rule unique search about it

            ],
            "quality" => "required|" . Rule::in([1, 2, 3, 4, 5]),
            "title" => "required|string|max:50",
            "review" => "required|string|max:255",

        ];


        if (in_array($this->getMethod(), ['PUT', 'PATCH'])) {
            $rules['product_id'] = [
                Rule::unique('product_reviews')->where(function ($query) {
                    return $query->where('user_id', user()->id);
                })->ignore($this->product_id,'product_id'),
                'required' // dosent work before rule unique search about it
             ];

        }




        return $rules;
    }



    public function attributes()
    {
        return [
            "review" => __('front.review'),
            "quality" => __('front.quality'),
            'product_id' => 'product',
        ];
    }


    public function messages()
    {
        return [
            "product_id.unique" => "!you added review for this product",
        ];
    }


}
