<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Http\Traits\HandelSlugTrait;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            "slug" => "required|string|" . Rule::unique('products', 'slug')->ignore($this->product),
            "sku" => "required|string|" . Rule::unique('products', 'sku')->ignore($this->product),
            "name" =>   "required|array|min:1|max:" . count(supportedLanguages()),
            "name.*" =>   "required|string|min:2|max:150|" . Rule::unique('product_translations', 'name'),
            "description" =>   "required|array|min:1|max:" . count(supportedLanguages()),
            "description.*" =>   "required|string|min:2|max:550",
            "brand_id" => "sometimes|nullable|numeric|exists:brands,id",

            "categories" => "required|array|min:1",
            'categories.*' => 'numeric|exists:categories,id',

            "tags" => "sometimes|nullable|array|min:1",
            'tags.*' => 'numeric|exists:tags,id',

            "meta_keywords" => "sometimes|nullable|string|max:100",
            "is_active" => "sometimes|nullable",

        ];

        if (in_array($this->getMethod(), ['PUT', 'PATCH'])) {
            $rules['name.*'] = "required|string|min:2|max:150|" . Rule::unique('product_translations', 'name')->ignore($this->product->id, 'product_id');
        }


        return $rules;
    }


    public function attributes()
    {
        return [
            "name.*" => 'input',
        ];
    }
}
