<?php

namespace App\Http\Controllers\Auth;

use App\Enums\RoleEnum;
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
        $user = User::create($request->validated());
        $user->assignRole(RoleEnum::CLIENT);
        return new UserResource($user->load('district'));
    }
}
