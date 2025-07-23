<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index(Request $request)
    {
        $genres = Genre::withCount('books')
            ->paginate($request->input('per_page', 15));

        if ($genres->isEmpty()) {
            abort(404);
        }

        return response()->json($genres);
    }
}
