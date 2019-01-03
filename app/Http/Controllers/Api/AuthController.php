<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser as StoreUserRequest;
use App\Http\Resources\User as UserResource;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ( ! auth()->attempt($request->only(['email', 'password']))) {
            return response()->json(['error' => 'Unauthorized']);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('API Token');

        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->endOfDay();
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => $token->expires_at->toDateTimeString()
        ]);
    }

    public function register(StoreUserRequest $request)
    {
        $user = new User();
        $user->fill($request->only($user->getFillable()));
        $user->password = bcrypt($request->password);

        if ($user->save()) {
            return new UserResource($user);
        }
    }
}