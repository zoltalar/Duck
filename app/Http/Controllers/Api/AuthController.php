<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use App\User;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), User::rules());

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->toArray()]);
        }

        $user = new User();
        $data = $request->only($user->getFillable());
        $data['password'] = bcrypt($data['password']);
        $user->fill($data);

        if ($user->save()) {
            return new UserResource($user);
        }
    }
}