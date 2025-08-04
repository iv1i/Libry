<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Services\Public\GenreService;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index(Request $request)
    {
        $res = GenreService::index($request);
        return response()->json($res);
    }
}
