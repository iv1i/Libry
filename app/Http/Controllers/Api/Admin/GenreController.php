<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use App\Services\Admin\GenreService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;

class GenreController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $res = GenreService::index($request);
        return GenreResource::collection($res);
    }

    public function store(Request $request): GenreResource
    {
        $res = GenreService::store($request);
        return new GenreResource($res);
    }

    public function show(Genre $genre): GenreResource
    {
        $res = GenreService::show($genre);
        return new GenreResource($res);
    }

    public function update(Request $request, Genre $genre): GenreResource
    {
        $res = GenreService::update($request, $genre);
        return new GenreResource($res);
    }

    public function destroy(Genre $genre): JsonResponse
    {
        $res = GenreService::destroy($genre);
        return response()->json($res);
    }
}
