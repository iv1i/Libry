<?php

namespace App\Http\Controllers\Api\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\AuthorProfileUpdateRequest;
use App\Services\Author\ProfileService;

class AuthorController extends Controller
{
    public function update(AuthorProfileUpdateRequest $request)
    {
        $res = ProfileService::update($request);
        return response()->json($res);
    }
}
