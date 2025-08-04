<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminBookIndexRequest;
use App\Http\Requests\Admin\AdminBookStoreRequest;
use App\Http\Requests\Admin\AdminBookUpdateRequest;
use App\Models\Book;
use App\Services\Admin\BookService;

class BookController extends Controller
{
    public function index(AdminBookIndexRequest $request)
    {
        $res = BookService::index($request);
        return response()->json($res);
    }
    public function store(AdminBookStoreRequest $request)
    {
        $res = BookService::store($request);
        return response()->json($res);

    }
    public function show(Book $book)
    {
        $res = BookService::show($book);
        return response()->json($res);
    }
    public function update(AdminBookUpdateRequest $request, Book $book)
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
