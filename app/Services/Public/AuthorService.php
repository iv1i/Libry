<?php

namespace App\Services\Public;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorService
{
    public static function index(Request $request)
    {
        $authors = Author::withCount('books')
            ->paginate($request->input('per_page', 15));

        if ($authors->isEmpty()) {
            abort(404);
        }

        return $authors;
    }

    public static function show(Author $author)
    {
        return $author->load('books');
    }
}
