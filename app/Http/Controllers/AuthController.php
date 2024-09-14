<?php

namespace App\Http\Controllers;

use App\Helpers\JsonResponseHelper;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $token = auth()->guard('api')->attempt($credentials);
        if (!$token) {
            return JsonResponseHelper::unauthorized('Password incorrect for: ' . $request->username);
        }
        $token = JWTAuth::fromUser(auth()->guard('api')->user());
        return JsonResponseHelper::success('Login successful', ['token' => $token, 'minutes_to_expire' => 1440]);
    }
}
