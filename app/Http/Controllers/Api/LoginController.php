<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::where('username', $validated['username'])->firstOrFail();

        $tokenName = 'autn_token';
        $token = $user->createToken($tokenName);

        return response()->success($token->plainTextToken, 'Login successful, use the following token for your authentication');
    }
}
