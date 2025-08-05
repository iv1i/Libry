<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminBookIndexRequest;
use App\Http\Requests\Admin\AdminBookStoreRequest;
use App\Http\Requests\Admin\AdminBookUpdateRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Services\Admin\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookController extends Controller
{
    public function index(AdminBookIndexRequest $request): AnonymousResourceCollection
    {
        $res = BookService::index($request);
        return BookResource::collection($res);
    }
    public function store(AdminBookStoreRequest $request): BookResource
    {
        $res = BookService::store($request);
        return new BookResource($res);
    }
    public function show(Book $book): BookResource
    {
        $res = BookService::show($book);
        return new BookResource($res);
    }
    public function update(AdminBookUpdateRequest $request, Book $book): BookResource
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
