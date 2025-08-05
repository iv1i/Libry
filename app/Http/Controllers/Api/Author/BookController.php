<?php

namespace App\Http\Controllers\Api\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\AuthorBookUpdateRequest;
use App\Http\Requests\Public\BookIndexRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Services\Author\BookService;
use App\Services\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookController extends Controller
{
    public function index(BookIndexRequest $request): AnonymousResourceCollection
    {
        $res = Service::indexBook($request);
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
