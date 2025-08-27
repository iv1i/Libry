<?php

namespace App\Services\Public;

use App\Models\Author;
use App\Services\Service;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class AuthorService extends Service
{
    public static function index(): LengthAwarePaginator
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
