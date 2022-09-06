<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponser
{
    public function successResponse($data,$code = Response::HTTP_OK): JsonResponse
    {
        return response()->json(['data' => $data],$code);
    }

    public function errorResponse($message, $code): JsonResponse
    {
        return response()->json(['message' => $message, 'code' => $code],$code);
    }
}
