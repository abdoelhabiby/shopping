<?php


namespace App\Http\Traits;

trait GetBladeErrorTrait {

    protected function getBladeError($request)
    {

        if($request->is('dashboard*')){
            abort(404);
        }

        return view('errors.missing_404',[],404);

    }
}
