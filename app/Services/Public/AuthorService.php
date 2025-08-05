<?php

namespace App\Services\Public;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorService
{
    public static function index(Request $request): Author
    {
        $authors = Author::withCount('books')
            ->paginate();

        if ($authors->isEmpty()) {
            abort(404);
        }

        return $authors;
    }

    public static function show(Author $author): Author
    {
        return $author->load('books');
    }
}
