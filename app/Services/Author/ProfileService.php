<?php

namespace App\Services\Author;

use App\Http\Requests\Author\AuthorProfileUpdateRequest;
use App\Models\Author;
use Illuminate\Support\Facades\Hash;


class ProfileService
{
    public static function update(AuthorProfileUpdateRequest $request): Author
    {
        $author = $request->user();

        if (isset($request->validated()['password'])) {
            $request->validated()['password'] = Hash::make($request->validated()['password']);
        }

        $author->update($request->validated());

        return $author;
    }
}
