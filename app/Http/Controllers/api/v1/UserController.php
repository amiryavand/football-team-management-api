<?php

namespace App\Http\Controllers\api\v1;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),  [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails())
            return response()->json(['errors' => $validator->errors(), 'status_code' => 400], 400);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json(['message' => 'User Registered Successfully', 'data' => $user, 'status_code' => 201], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),  [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails())
            return response()->json(['errors' => $validator->errors(), 'status_code' => 400], 400);

        if(!auth()->validate([ 'email' => $request->email, 'password' => $request->password]))
            return response()->json(['message' => 'Credentials Incorrect', 'status_code' => 401], 401);

        $user = User::whereEmail($request->email)->first();
        $token = $user->createToken('ApiToken')->accessToken;

        return response()->json(['user' => $user, 'access_token' => $token, 'status_code' => 200], 200);
    }
}
