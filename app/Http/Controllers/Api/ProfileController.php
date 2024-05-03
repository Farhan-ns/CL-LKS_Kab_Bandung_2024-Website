<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Profile
     * 
     * Mengambil profile pemilik token
     * 
     * @authenticated
     * @response {"success":true,"code":200,"message":"Profile fetched","data":{"id":3,"name":"Hans","email":"xyz@mail.com","email_verified_at":null,"created_at":"2024-04-29T12:35:13.000000Z","updated_at":"2024-04-29T12:35:13.000000Z","username":"boedi123","address":"Jl. Ahmad Yani 321"}}
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();

        return response()->success($user, 'Profile fetched');
    }
}
