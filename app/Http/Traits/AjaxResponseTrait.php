<?php


namespace App\Http\Traits;


trait AjaxResponseTrait
{

    public function successMessage($msg='')
    {
        $data = [
            'status' => true,
            'msg' => $msg
        ];

        return response()->json($data, 200);

    }

    public function responseData($value)
    {

        $data = [
            'status' => true,
            'rows' => $value
        ];

        return response()->json($data, 200);
    }


    public function responseValidationErrors($errors)
    {

        $data = [
            'status' => false,
            'errors' => $errors
        ];

        return response()->json($data, 422);
    }




    public function notfound()
    {
        return response()->json('notfound', 404);
    }


}
