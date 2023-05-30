<?php

namespace App\Services;

use App\Interfaces\Repositories\IService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class Service implements IService
{
    public function responseSuccess(string $message = 'Success.') : JsonResponse
    {
        return response()->json([
            'status' => 200,
            'message' => $message,
        ], 200);
    }

    public function responseWithData(array $data) : JsonResponse
    {
        return response()->json($data, 200);
    }

    public function responseWithToken(string $token) : JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }

    public function responseResourceCreated(string $message = 'Resource created.') : JsonResponse
    {
        return response()->json([
            'status' => 201,
            'message' => $message,
        ], 201);
    }

    public function responseUnauthorized(string $errors = 'Unauthorized.') : JsonResponse
    {
        return response()->json([
            'status' => 401,
            'errors' => $errors,
        ], 401);
    }

    public function responseUnprocessable(string $errors) : JsonResponse
    {
        return response()->json([
            'status' => 422,
            'errors' => $errors,
        ], 422);
    }

    public function responseServerError(string $errors = 'Server error.') : JsonResponse
    {
        return response()->json([
            'status' => 500,
            'errors' => $errors
        ], 500);
    }
}
