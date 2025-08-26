<?php

namespace App\Services\Author;

use App\Http\Requests\Author\AuthorBookUpdateRequest;
use App\Models\Author;
use App\Models\Book;
use App\Services\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookService extends Service
{
    public static function update(AuthorBookUpdateRequest $request, Book $book): array|Book
    {
        if ($book->author_id !== Auth::guard('author')->id()) {
            return [
                'error' => 'Unauthorized action.'
            ];
        }

        $book->update($request->validated());

        if ($request->has('genres')) {
            $book->genres()->sync($request->validated()['genres']);
        }

        return $book->load('genres');
    }

    public static function destroy(Book $book): array
    {
        if ($book->author_id !== Auth::guard('author')->id()) {
            return [
                'error' => 'Unauthorized action.'
            ];
        }

        $book->delete();

        return ['message' => "Book {$book->title} (ID: {$book->id}) deleted"];
    }
}
