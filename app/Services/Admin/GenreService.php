<?php

namespace App\Services\Admin;

use App\Models\Genre;
use App\Services\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GenreService extends Service
{
    public static function index(Request $request)
    {
        $genres = Genre::withCount('books')
            ->paginate();

        if ($genres->isEmpty()) {
            abort(404);
        }

        return $genres;
    }

    public static function store(Request $request)
    {
        $genre = Genre::create($request->validated());
        return $genre;
    }

    public function show(Genre $genre)
    {
        return $genre->load('books');
    }

    public static function update(Request $request, Genre $genre)
    {
        $genre->update($request->validated());
        return response()->json($genre);
    }
    public static function destroy(Genre $genre)
    {
        $genre->delete();
        return ['message' => "Genre {$genre->name} (ID: {$genre->id}) deleted"];
    }
}
