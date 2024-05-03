<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Register
     * 
     * Mendaftarkan user baru dan mendapatkan token otentikasi
     * 
     * @unauthenticated
     * @bodyParam name string required Nama akun. Example: Budi
     * @bodyParam username string required Username akun. Example: boedi123
     * @bodyParam password string required Password Akun. Example: pass
     * @bodyParam address string required Alamat. Example: Jl. Soebroto 321
     * @response {"success":true,"code":200,"message":"Registration successful, use the following token for your authentication","data":{"user":{"name":"Hans","username":"boedi123","address":"Jl. Ahmad Yani 321","email":"xyz@mail.com","updated_at":"2024-04-29T12:35:13.000000Z","created_at":"2024-04-29T12:35:13.000000Z","id":3},"token":"7|rTSSW51wmig5MIvxstf5g1HxoYtlZUpyKX9dvuuI59ce2cf8"}}
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
