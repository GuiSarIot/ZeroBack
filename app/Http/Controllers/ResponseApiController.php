<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ResponseApiController extends Controller
{
    
    public static function success($data = [], $status = 200, $message = 'The request has succeeded.')
    {
        return response()->json([
            'status' => 'success',
            'message' => $message, 
            'data' => $data
        ], $status);
    }

    public static function error($message = '.', $status = 400)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => []
        ], $status);
    }

}
