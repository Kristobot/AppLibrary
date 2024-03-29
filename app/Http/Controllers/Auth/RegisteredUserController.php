<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\UserResource;

class RegisteredUserController extends Controller
{
    //
    public function register(RegisterUserRequest $request)
    {
        $user = user::create($request->validated());
        return new UserResource($user);
    }
}
