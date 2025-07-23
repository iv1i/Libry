<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::with('author')
            ->paginate($request->input('per_page', 15));

        Log::channel('library')->info("The guest requested all the books");

        if ($books->isEmpty()) {
            abort(404);
        }

        return response()->json($books);
    }

    public function show(Book $book)
    {
        Log::channel('library')->info("The guest requested a book {$book->id}");
        return response()->json($book->load('author', 'genres'));
    }
}
