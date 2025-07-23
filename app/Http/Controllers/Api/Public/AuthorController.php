<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $authors = Author::withCount('books')
            ->paginate($request->input('per_page', 15));

        if ($authors->isEmpty()) {
            abort(404);
        }

        return response()->json($authors);
    }

    public function show(Author $author)
    {
        return response()->json($author->load('books'));
    }
}
