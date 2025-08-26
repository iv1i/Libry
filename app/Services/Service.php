<?php

namespace App\Services;

use App\Http\Requests\Public\BookIndexRequest;
use App\Models\Book;
use Illuminate\Pagination\LengthAwarePaginator;

class Service
{
    public static function indexBook(BookIndexRequest $request): LengthAwarePaginator
    {
        $books = Book::with(['author', 'genres'])
            ->filterByTitle($request->title)
            ->filterByAuthorName($request->author)
            ->filterByGenres($request->genres)
            ->sortByTitle($request->sort)
            ->paginate();

        if ($books->isEmpty()) {
            abort(404);
        }

        return $books;
    }
}
