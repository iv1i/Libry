<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Services\Admin\GenreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GenreController extends Controller
{
    public function index(Request $request)
    {
        $res = GenreService::index($request);
        return response()->json($res);
    }

    public function store(Request $request)
    {
        $res = GenreService::store($request);
        return response()->json($res);
    }

    public function show(Genre $genre)
    {
        $res = GenreService::show($genre);
        return response()->json($res);
    }

    public function update(Request $request, Genre $genre)
    {
        $res = GenreService::update($request, $genre);
        return response()->json($res);
    }

    public function destroy(Genre $genre)
    {
        $res = GenreService::destroy($genre);
        return response()->json($res);
    }
}
