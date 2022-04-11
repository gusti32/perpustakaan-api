<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|string|min:8|max:255'
            ],
            [
                'name.required' => 'Field name harus diisi.',
                'name.max' => 'Nama terlalu panjang (maksimal 255 karakter).',

                'email.required' => 'Field email harus diisi.',
                'email.email' => 'E-mail tidak valid',
                'email.unique' => 'E-mail sudah terdaftar.',

                'password.required' => 'Field password harus diisi.',
                'password.min' => 'Password harus memiliki minimal 8 karakter.'
            ]);

        if ($validator->fails()) {
            return ["errors" => $validator->errors()];
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return ['msg' => 'Berhasil! Silahkan login untuk mendapatkan token API.'];
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'email' => 'required|string|email|exists:users,email',
                'password' => 'required|string|min:8'
            ],
            [
                'name.required' => 'Field name harus diisi.',
                'name.max' => 'Nama terlalu panjang (maksimal 255 karakter).',

                'email.required' => 'Field email harus diisi.',
                'email.email' => 'E-mail tidak valid',
                'email.exists' => 'E-mail tidak terdaftar.',

                'password.required' => 'Field password harus diisi.',
                'password.min' => 'Password harus memiliki minimal 8 karakter.'
            ]);

        if ($validator->fails()) {
            return ["errors" => $validator->errors()];
        }

        // Find user by email
        $user = User::where('email', $request->email)->first();

        // Check the password
        if (!Hash::check($request->password, $user->password)) {
            return ['errors' => 'Password salah.'];
        }

        // Revoke existing token
        // Any request will fail if user tries to create a request with old token.
        if ($user->tokens()->count() > 0) {
            $user->tokens()->delete();
        }

        // Create and pass new token
        return ['token' => $user->createToken('access_token')->plainTextToken];
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return ['msg' => 'Berhasil'];
    }
}
