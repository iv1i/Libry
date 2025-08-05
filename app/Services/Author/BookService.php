<?php

namespace App\Services\Author;

use App\Http\Requests\Author\AuthorBookUpdateRequest;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookService
{
    public static function index(Request $request): Book|JsonResponse
    {
        if (!Auth::guard('author')->check()) {
            return response()->json([
                'error' => 'Unauthorized action.'
            ], 403);
        }
        $books = Auth::guard('author')->user()->books()
            ->with('genres')
            ->paginate();

        if ($books->isEmpty()) {
            abort(404);
        }

        return $books;
    }

    public static function update(AuthorBookUpdateRequest $request, Book $book): Book|JsonResponse
    {
        if ($book->author_id !== Auth::guard('author')->id()) {
            return response()->json([
                'error' => 'Unauthorized action.'
            ], 403);
        }

        $book->update($request->validated());

        if ($request->has('genres')) {
            $book->genres()->sync($request->validated()['genres']);
        }

        return $book->load('genres');
    }

    public static function destroy(Book $book): array|JsonResponse
    {
        if ($book->author_id !== Auth::guard('author')->id()) {
            return response()->json([
                'error' => 'Unauthorized action.'
            ], 403);
        }

        $book->delete();

        return ['message' => "Book {$book->title} (ID: {$book->id}) deleted"];
    }
}
