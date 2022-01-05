<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function register(Request $request)
    {   if(Auth()->user()->isAdmin()) {
       
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|string|max:50|email|unique:users',
            'password' => 'required|string|regex:"^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$"',
        ]);

        if ($validator->fails())

            return response()->json($validator->errors());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            //'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            //'remember_token' => Str::random(10),
            
        ]);

        //$token = $user->createToken('auth_token')->plainTextToken;

       $user->remember_token = Str::random(10);
       $user->email_verified_at = now();
       $user->save();
       return response()->json(['data' => $user]);
       //'access_token' => $token, 'token_type' => 'Bearer'
    

        //return response()->json('Successfully registered doctor.');

    }
    else return response()->json('Unauthorized');
}

    public function login(Request $request)

    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }
        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()

            ->json(['message' => 'Hi ' . $user->name . ', welcome, ', 'access_token' => $token, 'token_type' => 'Bearer',]);

    }

    public function logout()

    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'You have successfully logged out and the token was successfully deleted.'
        ];

    }
}