<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Services\Public\AuthorService;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $res = AuthorService::index($request);
        return response()->json($res);
    }

    public function show(Author $author)
    {
        $res = AuthorService::show($author);
        return response()->json($res);
    }
}
