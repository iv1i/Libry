<?php

namespace App\Services\Public;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreService
{
    public static function index(Request $request)
    {
        $genres = Genre::withCount('books')
            ->paginate($request->input('per_page', 15));

        if ($genres->isEmpty()) {
            abort(404);
        }

        return $genres;
    }
}
