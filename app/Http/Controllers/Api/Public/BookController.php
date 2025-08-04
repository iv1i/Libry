<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Services\Public\BookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $res = BookService::index($request);
        return response()->json($res);
    }

    public function show(Book $book)
    {
        $res = BookService::show($book);
        return response()->json($res);
    }
}
