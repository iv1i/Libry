<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\GenreResource;
use App\Services\Public\GenreService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GenreController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $res = GenreService::index();

        return GenreResource::collection($res);
    }
}
