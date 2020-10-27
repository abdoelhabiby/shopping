<?php


namespace App\Http\Traits;


trait HandelSlugTrait
{
    //--------------------make slug prety--------------------

    protected function prepareForValidation()
    {
        if ($this->has('slug'))
            $this->merge([
                'slug' => str_replace(" ", "-", preg_replace("/\s+/", " ", trim($this->request->get('slug'))))
            ]);
    }
}
