<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController
{
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only(['email', 'password']))) {
            $token = auth()->user()->createToken('user');
            return response()->json(['token' => $token->plainTextToken]);
        }

        return response()->json('Given data doesn\'t match our records', 422);
    }
}
