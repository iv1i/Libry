<?php

namespace App\Http\Controllers\Api\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\AuthorProfileUpdateRequest;
use App\Http\Resources\AuthorResource;
use App\Services\Author\ProfileService;

class AuthorController extends Controller
{
    public function update(AuthorProfileUpdateRequest $request): AuthorResource
    {
        $res = ProfileService::update($request);

        return new AuthorResource($res);
    }
}
