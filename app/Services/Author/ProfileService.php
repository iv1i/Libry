<?php

namespace App\Services\Author;

use App\Http\Requests\Author\AuthorProfileUpdateRequest;
use Illuminate\Support\Facades\Hash;


class ProfileService
{
    public static function update(AuthorProfileUpdateRequest $request)
    {
        $author = $request->user();

        if (isset($request->validated()['password'])) {
            $request->validated()['password'] = Hash::make($request->validated()['password']);
        }

        $author->update($request->validated());

        return $author;
    }
}
