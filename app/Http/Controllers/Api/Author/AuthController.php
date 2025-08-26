<?php

namespace App\Http\Controllers\Api\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\AuthorAuthRequest;
use App\Services\AuthorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(AuthorAuthRequest $request): JsonResponse
    {
        $res = AuthorService::login($request);

        return response()->json($res);
    }

    public function logout(Request $request): JsonResponse
    {
        $res = AuthorService::logout($request);

        return response()->json($res);
    }

}

