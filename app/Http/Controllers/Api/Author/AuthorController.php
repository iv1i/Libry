<?php

namespace App\Http\Controllers\Api\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use \Illuminate\Validation\Rules\Password;

class AuthorController extends Controller
{
    public function update(Request $request)
    {
        $author = $request->user();

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:authors,email,'.$author->id,
            'password' => ['sometimes', Password::defaults()],
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $author->update($validated);

        Log::channel('library')->info("Author {$author->id} updated profile");

        return response()->json($author);
    }
}
