<?php

namespace App\Http\Controllers\Api\Author;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Services\ExceptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $author = Author::where('email', $request->email)->first();

            if (!$author || !Hash::check($request->password, $author->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            $token = $author->createToken('author-token')->plainTextToken;

            return response()->json([
                'message' => 'Logged in successfully',
                'token' => $token,
                'author' => $author
            ]);
        } catch (ValidationException $e) {
            return ExceptionService::respondWithValidationError($e->validator->errors()->first());
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }

}

