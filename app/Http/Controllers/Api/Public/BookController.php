<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Services\Public\BookService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $res = BookService::index($request);
        return BookResource::collection($res);
    }

    public function show(Book $book): BookResource
    {
        $res = BookService::show($book);
        return new BookResource($res);
    }
}
