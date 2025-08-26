<?php

namespace App\Services\Admin;

use App\Models\Genre;
use App\Services\Service;
use Illuminate\Http\Request;

class GenreService extends Service
{
    public static function index(): Genre
    {
        $genres = Genre::withCount('books')
            ->paginate();

        if ($genres->isEmpty()) {
            abort(404);
        }

        return $genres;
    }

    public static function store(Request $request): Genre
    {
        $genre = Genre::create($request->validated());

        return $genre;
    }

    public function show(Genre $genre): Genre
    {
        return $genre->load('books');
    }

    public static function update(Request $request, Genre $genre): Genre
    {
        $genre->update($request->validated());

        return $genre;
    }
    public static function destroy(Genre $genre): array
    {
        $genre->delete();

        return ['message' => "Genre {$genre->name} (ID: {$genre->id}) deleted"];
    }
}
