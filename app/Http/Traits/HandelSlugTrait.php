<?php


namespace App\Http\Traits;

use Illuminate\Support\Str;


trait HandelSlugTrait
{
    //--------------------make slug prety--------------------

    protected function prepareForValidation()
    {
        if ($this->has('slug'))

       $slug = Str::slug($this->request->get('slug'));

            $this->merge([
                'slug' => $slug
            ]);
    }
}
