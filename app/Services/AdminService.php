<?php

namespace App\Services;


use App\Http\Requests\Admin\AdminAuthRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminService
{
    public static function login(AdminAuthRequest $request): array
    {
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $admin->createToken('admin-token')->plainTextToken;

        return [
            'message' => 'Logged in successfully',
            'token' => $token,
            'admin' => $admin
        ];
    }

    public static function logout(Request $request): array
    {
        $request->user()->currentAccessToken()->delete();

        return ['message' => 'Logged out successfully'];
    }
}
