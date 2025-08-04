<?php

namespace App\Http\Controllers\Api\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\AuthorBookUpdateRequest;
use App\Models\Book;
use App\Services\Author\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $res = BookService::index($request);
        return response()->json($res);
    }

    public function update(AuthorBookUpdateRequest $request, Book $book)
    {
        $res = BookService::update($request, $book);
        return response()->json($res);
    }

    public function destroy(Book $book)
    {
        $res = BookService::destroy($book);
        return response()->json($res);
    }
}
