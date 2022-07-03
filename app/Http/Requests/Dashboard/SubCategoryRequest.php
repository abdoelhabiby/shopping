<?php

namespace App\Http\Requests\Dashboard;

use App\Models\Category;
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
            'parent_id' => 'required|integer|' . Rule::in($this->getIdsCategoryMainSubCategory()),
            "slug" => "required|string|" . Rule::unique('categories', 'slug')->ignore($this->sub_category),
            "name" =>   "required|array|min:1|max:" . count(supportedLanguages()),
            "name.*" =>   "required|string|min:2|max:150|" . Rule::unique('category_translations', 'name'),
            "meta_keywords" => "sometimes|nullable|string|max:100",
            "meta_description" => "sometimes|nullable|string|max:500",
            "image" => "sometimes|nullable|image|mimes:png,jpg,jpeg|max:8000",
            "is_active" => "sometimes|nullable|",

        ];

        if (in_array($this->getMethod(), ['PUT', 'PATCH'])) {

            $rules["name.*"] = "required|string|min:2|max:150|" . Rule::unique('category_translations', 'name')->ignore($this->sub_category->id, 'category_id');
        }


        return $rules;
    }


    public function attributes()
    {
        return [
            "name.*" => 'input',
            "parent_id" => 'parent'
        ];
    }



    public function messages()
    {
        return [
            'parent_id.in' => 'select valid data'
        ];
    }



    // -----------------------------
    public function getIdsCategoryMainSubCategory(): array
    {


        $categories = Category::where('parent_id', null)
            ->orWhere(function ($q) {
                $q->whereHas('parent', function ($q) {  // sub categories
                    $q->where('parent_id', null)->when(($this->sub_category), function ($q) {
                        $q->where('id', '!=', $this->sub_category->id);
                    });
                });
            })
            ->when(($this->sub_category), function ($q) {
                $q->where('id', '!=', $this->sub_category->id);
            })
            ->pluck('id')->toArray();

        return $categories;
    }
    // -----------------------------





}
