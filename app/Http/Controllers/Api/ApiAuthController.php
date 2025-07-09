<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    /**
     * Handle user login and return API token.
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $credentials['email'])->first();

        // Verifikasi user dan password
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'message' => 'Email atau password salah.'
            ], 401);
        }

        // Buat token baru
        $token = $user->createToken('api-token')->plainTextToken;

        // Return token dan data user
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    /**
     * Logout and revoke token.
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Berhasil logout.'
        ]);
    }
}
