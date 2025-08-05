<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\BookIndexRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Services\Public\BookService;
use App\Services\Service;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookController extends Controller
{
    public function index(BookIndexRequest $request): AnonymousResourceCollection
    {
        $res = Service::indexBook($request);
        return BookResource::collection($res);
    }

    public function show(Book $book): BookResource
    {
        $res = BookService::show($book);
        return new BookResource($res);
    }
}
