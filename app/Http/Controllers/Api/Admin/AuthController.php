<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminAuthRequest;
use App\Services\AdminService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(AdminAuthRequest $request): JsonResponse
    {
        $res = AdminService::login($request);

        return response()->json($res);
    }

    public function logout(Request $request): JsonResponse
    {
        $res = AdminService::logout($request);

        return response()->json($res);
    }
}
