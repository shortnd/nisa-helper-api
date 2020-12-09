<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('show');
    }

    public function show(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }
}
