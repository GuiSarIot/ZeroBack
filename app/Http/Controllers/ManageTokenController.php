<?php

//* controllers
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseApiController;

//* libraries
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class ManageTokenController extends Controller
{
    
    //* generate token for postman
    public static function generateTokenPostman(Request $request){
        $id = $request->route('id');

        if ($id == '') {
            return ResponseApiController::error('id no puede estar vacio');
        }

        $token = JWT::encode(['id' => $id], env('JWT_SECRET'), 'HS256');
        return ResponseApiController::success($token);
    }


    //* generate token for app
    public static function generateToken($id){
        $token = JWT::encode(['id' => $id], env('JWT_SECRET'), 'HS256');
        return $token;
    }


    //* validate token from a request
    public static function validateToken(Request $request){
        try {
            $tokenEncoded = substr($request->header('Authorization', 'token <token>'), 6);

            $tokenDecoded = JWT::decode($tokenEncoded, new Key(env('JWT_SECRET'), 'HS256'));

            return [
                'process' => 'success token',
                'message' => 'token valido',
                'state' => true,
                'token' => $tokenDecoded
            ];

        } catch (\Throwable $th) {
            return [
                'process' => 'error token',
                'message' => 'token invalido',
                'state' => false,
                'token' => ''
            ];
        }
    }
}
