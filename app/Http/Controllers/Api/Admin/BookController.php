<?php

namespace App\Http\Controllers\Api\Admin;

use App\Enums\BookType;
use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Services\ExceptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class BookController extends Controller
{
    private function makeId($q)
    {
        $table = [];
        foreach ($q as $item) {
            $table[] = $item->id;
        }
        $id = 1;

        foreach ($table as $value) {
            if ($value != $id) {
                break;
            }
            $id++;
        }
        return $id;
    }

    public function index(Request $request)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'author' => 'sometimes|string',
            'genres' => 'sometimes|string',
        ]);
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

        $books = $query->paginate($request->input('per_page', 15));

        Log::channel('library')->info("The admin requested books");

        return response()->json($books);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:books',
            'description' => 'nullable|string',
            'author' => 'required|string|exists:authors,name',
            'type' => 'required|in:' . implode(',', BookType::values()),
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,name',
        ]);
        $bookId = $this->makeId(Book::all());
        $author = Author::where('name', $request->author)->first();
        $validated['author_id'] = $author->id;
        $validated['id'] = $bookId;

        $book = Book::create($validated);
        $book->id = $bookId;
        $book->save();

        $genres = Genre::whereIn('name', $validated['genres'])->get();
        $book->genres()->sync($genres);

        Log::channel('library')->info("Book {$book->id} created by admin");

        return response()->json($book->load('author', 'genres'), 201);

    }
    public function show(Book $book)
    {
        Log::channel('library')->info("The admin requested a book {$book->id}");
        return response()->json($book->load('author', 'genres'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255|unique:books,title,'.$book->id,
            'description' => 'sometimes|string|nullable',
            'author' => 'sometimes|string|exists:authors,name',
            'type' => 'sometimes|in:' . implode(',', BookType::values()),
            'genres' => 'sometimes|array',
            'genres.*' => 'exists:genres,name',
        ]);

        $author = Author::where('name', $request->author)->first();
        $validated['author_id'] = $author->id;
        $book->update($validated);

        if ($request->has('genres')) {
            $genres = Genre::whereIn('name', $validated['genres'])->get();
            $book->genres()->sync($genres);        }

        Log::channel('library')->info("Book {$book->id} updated by admin");

        return response()->json($book->load('author', 'genres'));
    }
    public function destroy(Book $book)
    {
        $book->delete();

        Log::channel('library')->info("Book {$book->id} deleted by admin");

        return response()->json(['message' => "Book deleted"]);
    }
}
