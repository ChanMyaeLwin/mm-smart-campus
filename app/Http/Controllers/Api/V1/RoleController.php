<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['message' => 'Roles endpoint - implementation pending'], 501);
    }

    public function store(): JsonResponse
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function show(): JsonResponse
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function update(): JsonResponse
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function destroy(): JsonResponse
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }
}