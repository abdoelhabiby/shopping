<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{

    protected function responseJson($error = true, $responseCode = 200, $message = [], $data = null)
    {
        return response()->json([
            'error'         =>  $error,
            'response_code' => $responseCode,
            'message'       => $message,
            'data'          =>  $data
        ]);
    }

}
