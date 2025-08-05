<?php

namespace App\Services\Public;

use App\Models\Author;
use App\Services\Service;
use Illuminate\Http\Request;

class AuthorService extends Service
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
