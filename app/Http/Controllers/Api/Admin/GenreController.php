<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GenreController extends Controller
{
    public function index(Request $request)
    {
        $genres = Genre::withCount('books')
            ->paginate($request->input('per_page', 15));

        return response()->json($genres);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:genres',
        ]);

        $genre = Genre::create($validated);

        Log::channel('library')->info("Genre {$genre->id} created by admin");

        return response()->json($genre, 201);
    }

    public function show(Genre $genre)
    {
        return response()->json($genre->load('books'));
    }

    public function update(Request $request, Genre $genre)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255|unique:genres,name,'.$genre->id,
        ]);

        $genre->update($validated);

        Log::channel('library')->info("Genre {$genre->id} updated by admin");

        return response()->json($genre);
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();

        Log::channel('library')->info("Genre {$genre->id} deleted by admin");

        return response()->json(['message' => 'Genre deleted']);
    }
}
