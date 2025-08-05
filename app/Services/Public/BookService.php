<?php

namespace App\Services\Public;

use App\Models\Book;
use Illuminate\Http\Request;

class BookService
{
    public static function index(Request $request): \Illuminate\Pagination\LengthAwarePaginator
    {
        $books = Book::with('author')
            ->paginate();

        if ($books->isEmpty()) {
            abort(404);
        }

        return $books;
    }

    public static function show(Book $book): Book
    {
        return $book->load('author', 'genres');
    }
}
