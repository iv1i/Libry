<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\AdminAuthorStoreRequest;
use App\Http\Requests\Admin\AdminAuthorUpdateRequest;
use App\Models\Author;
use App\Services\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthorService extends Service
{
    public static function index(Request $request): Author
    {
        $authors = Author::withCount('books')
            ->paginate($request->input('per_page', 15));

        if ($authors->isEmpty()) {
            abort(404);
        }

        return $authors;
    }

    public static function store(AdminAuthorStoreRequest $request): Author
    {
        $request->validated()['password'] = Hash::make($request->validated()['password']);

        return Author::create($request->validated());
    }

    public static function show(Author $author): Author
    {
        return $author->load('books');
    }

    public static function update(AdminAuthorUpdateRequest $request, Author $author): Author
    {
        if (isset($request->validated()['password'])) {
            $request->validated()['password'] = Hash::make($request->validated()['password']);
        }

        $author->update($request->validated());

        return $author;
    }

    public static function destroy(Author $author): array
    {
        $author->delete();
        return ['message' => "Author {$author->name} (ID: {$author->id}) deleted"];
    }
}
