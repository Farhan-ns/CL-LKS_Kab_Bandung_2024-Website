<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Login 
     * 
     * Login untuk mendapatkan token otentikasi
     * 
     * @unauthenticated
     * @bodyParam username string required Username Akun. Example: boedi123
     * @bodyParam password string required Password Akun. Example: pass
     * @response {"success":true,"code":200,"message":"Login successful, use the following token for your authentication","data":"8|mUyx2tEKIZcr38dJdONFzSlLlNTbw6ljYwwV8Tix75d66e0f"}
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
