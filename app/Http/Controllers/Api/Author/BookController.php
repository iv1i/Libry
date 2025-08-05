<?php

namespace App\Http\Controllers\Api\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\AuthorBookUpdateRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Services\Author\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $res = BookService::index($request);
        return BookResource::collection($res);
    }

    public function update(AuthorBookUpdateRequest $request, Book $book): BookResource
    {
        $res = BookService::update($request, $book);
        return new BookResource($res);
    }

    public function destroy(Book $book): JsonResponse
    {
        $res = BookService::destroy($book);
        return response()->json($res);
    }
}
