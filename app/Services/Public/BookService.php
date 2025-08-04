<?php

namespace App\Services\Public;

use App\Models\Book;
use Illuminate\Http\Request;

class BookService
{
    public static function index(Request $request)
    {
        $books = Book::with('author')
            ->paginate($request->input('per_page', 15));

        if ($books->isEmpty()) {
            abort(404);
        }

        return $books;
    }

    public static function show(Book $book)
    {
        return $book->load('author', 'genres');
    }
}
