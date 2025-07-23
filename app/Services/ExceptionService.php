<?php

namespace App\Services;

class ExceptionService
{
    public static function respondWithError(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'error' => 'Unknown error...'
        ], 500);
    }

    public static function respondWithValidationError($error): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'error' => $error
        ], 422);
    }
}
