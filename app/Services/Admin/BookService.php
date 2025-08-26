<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\AdminBookIndexRequest;
use App\Http\Requests\Admin\AdminBookStoreRequest;
use App\Http\Requests\Admin\AdminBookUpdateRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Services\Service;
use App\Services\Utility;

class BookService extends Service
{
    public static function show(Book $book): Book
    {
        return $book->load('author', 'genres');
    }
    public static function store(AdminBookStoreRequest $request): Book
    {
        $bookId = Utility::makeId(Book::all());
        $author = Author::where('name', $request->validated()['author'])->first();
        $request->validated()['author_id'] = $author->id;
        $request->validated()['id'] = $bookId;

        $book = Book::create($request->validated());
        $book->id = $bookId;
        $book->save();

        $genres = Genre::whereIn('name', $request->validated()['genres'])->get();
        $book->genres()->sync($genres);

        return $book->load('author', 'genres');
    }
    public static function update(AdminBookUpdateRequest $request, Book $book): Book
    {
        $author = Author::where('name', $request->author)->first();
        $validated['author_id'] = $author->id;
        $book->update($validated);

        if ($request->has('genres')) {
            $genres = Genre::whereIn('name', $validated['genres'])->get();
            $book->genres()->sync($genres);
        }

        return $book->load('author', 'genres');
    }
    public static function destroy(Book $book): array
    {
        $book->delete();

        return ['message' => "Book {$book->title} (ID: {$book->id}) deleted"];
    }
}
