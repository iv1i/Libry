<?php

namespace App\Services;

use App\Http\Requests\Public\BookIndexRequest;
use App\Models\Author;
use App\Models\Book;

class Service
{
    public static function indexBook(BookIndexRequest $request): \Illuminate\Pagination\LengthAwarePaginator
    {
        $query = Book::with(['author', 'genres']);

        if ($request->title) {
            $query->where('title', 'like', '%'.$request->title.'%');
        }

        if ($request->author) {
            $author = Author::where('name', $request->author)->first();
            if ($author) {
                $query->where('author_id', $author->id);
            }
        }

        if ($request->genres) {
            $query->whereHas('genres', function($q) use ($request) {
                $q->whereIn('name', explode(',', $request->genres));
            });
        }

        if ($request->sort === 'title') {
            $query->orderBy('title');
        }

        $books = $query->paginate();

        if ($books->isEmpty()) {
            abort(404);
        }

        return $books;
    }
}
