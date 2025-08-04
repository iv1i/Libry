<?php

namespace App\Services;

use App\Http\Requests\Author\AuthorAuthRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthorService
{
    public function login(AuthorAuthRequest $request)
    {
        $author = Author::where('email', $request->email)->first();

        if (!$author || !Hash::check($request->password, $author->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $author->createToken('author-token')->plainTextToken;

        return [
            'message' => 'Logged in successfully',
            'token' => $token,
            'author' => $author
        ];
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return ['message' => 'Logged out successfully'];
    }
}
