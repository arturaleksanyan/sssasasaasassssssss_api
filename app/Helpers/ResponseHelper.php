<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    public static function success($message, $status = 200): JsonResponse
    {
        return response()->json($message, $status);
    }

    public static function error($message, $status = 500): JsonResponse
    {
        return response()->json($message, $status);
    }
}