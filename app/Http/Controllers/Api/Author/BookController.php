<?php

namespace App\Http\Controllers\Api\Author;

use App\Enums\BookType;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Services\ExceptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class BookController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::guard('author')->check()) {
            return response()->json([
                'error' => 'Unauthorized action.'
            ], 403);
        }
        $books = Auth::guard('author')->user()->books()
            ->with('genres')
            ->paginate($request->input('per_page', 15));
        $authorId = Auth::guard('author')->user()->id;
        Log::channel('library')->info("The author {$authorId} requested books");

        return response()->json($books);
    }

    public function update(Request $request, Book $book)
    {
        if ($book->author_id !== Auth::guard('author')->id()) {
            return response()->json([
                'error' => 'Unauthorized action.'
            ], 403);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string|nullable',
            'type' => 'sometimes|in:' . implode(',', BookType::values()),
            'genres' => 'sometimes|array',
            'genres.*' => 'exists:genres,name',
        ]);

        $book->update($validated);

        if ($request->has('genres')) {
            $book->genres()->sync($validated['genres']);
        }

        Log::channel('library')->info("Book {$book->id} updated by author {$book->author_id}");

        return response()->json($book->load('genres'));
    }

    public function destroy(Book $book)
    {
        if ($book->author_id !== Auth::guard('author')->id()) {
            return response()->json([
                'error' => 'Unauthorized action.'
            ], 403);
        }

        $book->delete();

        Log::channel('library')->info("Book {$book->id} deleted by author {$book->author_id}");

        return response()->json(['message' => 'Book deleted']);
    }
}
