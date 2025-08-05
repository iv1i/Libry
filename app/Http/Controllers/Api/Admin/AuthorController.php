<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminAuthorStoreRequest;
use App\Http\Requests\Admin\AdminAuthorUpdateRequest;
use App\Http\Requests\Admin\AdminBookIndexRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use App\Services\Admin\AuthorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AuthorController extends Controller
{
    public function index(AdminBookIndexRequest $request): AnonymousResourceCollection
    {
        $res = AuthorService::index($request);
        return AuthorResource::collection($res);
    }

    public function store(AdminAuthorStoreRequest $request): AuthorResource
    {
        $res = AuthorService::store($request);
        return new AuthorResource($res);
    }

    public function show(Author $author): AuthorResource
    {
        $res = AuthorService::show($author);
        return new AuthorResource($res);
    }

    public function update(AdminAuthorUpdateRequest $request, Author $author): AuthorResource
    {
        $res = AuthorService::update($request, $author);
        return new AuthorResource($res);
    }

    public function destroy(Author $author): JsonResponse
    {
        $res = AuthorService::destroy($author);
        return response()->json($res);
    }
}
