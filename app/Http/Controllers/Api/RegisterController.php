<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'username' => ['required', 'unique:users,username'],
            'password' => ['required'],
            'address' => ['required'],
        ]);

        $validated['email'] = 'xyz@mail.com';
        $user = User::create($validated);

        $tokenName = 'autn_token';
        $token = $user->createToken($tokenName);

        return response()->success([
            'user' => $user,
            'token' => $token->plainTextToken
        ], 'Registration successful, use the following token for your authentication', 200);
    }
}
