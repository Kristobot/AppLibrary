<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticatedController extends Controller
{
    //
    public function login(LoginRequest $request)
    {
        if(Auth::attempt($request->validated()))
        {
            return response()->json(['token' => $request->user()->createToken('token')->plainTextToken], Response::HTTP_ACCEPTED);
        }

        return response()->json(['Error' => 'Crendentials Invalidated'], Response::HTTP_UNAUTHORIZED);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['Success' => 'Cerro Sesion Correctamente'], Response::HTTP_OK);
    }
}
