<?php

namespace App\Services\Public;

use App\Models\Book;
use App\Models\Genre;
use App\Services\Service;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class GenreService extends Service
{
    public static function index(Request $request): LengthAwarePaginator
    {
        $genres = Genre::withCount('books')
            ->paginate();

        if ($genres->isEmpty()) {
            abort(404);
        }

        return $genres;
    }
}
