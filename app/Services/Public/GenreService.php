<?php

namespace App\Services\Public;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreService
{
    public static function index(Request $request): \Illuminate\Pagination\LengthAwarePaginator
    {
        $genres = Genre::withCount('books')
            ->paginate();

        if ($genres->isEmpty()) {
            abort(404);
        }

        return $genres;
    }
}
