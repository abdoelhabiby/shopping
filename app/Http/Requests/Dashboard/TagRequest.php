<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Validation\Rule;
use App\Http\Traits\HandelSlugTrait;
use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            "slug" => "required|string|" . Rule::unique('tags', 'slug')->ignore($this->tag),
            "name" =>   "required|array|min:1|max:" . count(supportedLanguages()),
            "name.*" =>   "required|string|min:2|max:150|" . Rule::unique('tag_translations', 'name'),
            "is_active" => "sometimes|nullable|",

        ];

        if (in_array($this->getMethod(), ['PUT', 'PATCH'])) {
            $rules['name.*'] = "required|string|min:2|max:150|" . Rule::unique('tag_translations', 'name')->ignore($this->tag->id, 'tag_id');
        }


        return $rules;
    }


    public function attributes()
    {
        return [
            "name.*" => 'input',
            "main_category_id.exists" => 'main category'
        ];
    }







}
