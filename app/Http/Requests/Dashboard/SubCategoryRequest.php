<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Validation\Rule;
use App\Http\Traits\HandelSlugTrait;
use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
            "parent_id" => 'required|integer|exists:categories,id',
            "slug" => "required|string|" . Rule::unique('categories', 'slug')->ignore($this->sub_category),
            "name" =>   "required|array|min:1|max:" . count(supportedLanguages()),
            "name.*" =>   "required|string|min:2|max:150|" . Rule::unique('category_translations', 'name'),
            "meta_keywords" => "sometimes|nullable|string|max:100",
            "meta_description" => "sometimes|nullable|string|max:500",
            "image" => "sometimes|nullable|image|mimes:png,jpg,jpeg|max:8000",
            "is_active" => "sometimes|nullable|",

        ];

        if (in_array($this->getMethod(), ['PUT', 'PATCH'])) {
            $rules['name.*'] = "required|string|min:2|max:150|" . Rule::unique('category_translations', 'name')->ignore($this->sub_category->id, 'category_id');
        }


        return $rules;
    }


    public function attributes()
    {
        return [
            "name.*" => 'input'
        ];
    }







}
