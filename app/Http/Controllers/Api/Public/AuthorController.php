<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use App\Services\Public\AuthorService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AuthorController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $res = AuthorService::index();

        return AuthorResource::collection($res);
    }

    public function show(Author $author): AuthorResource
    {
        $res = AuthorService::show($author);

        return new AuthorResource($res);
    }
}
