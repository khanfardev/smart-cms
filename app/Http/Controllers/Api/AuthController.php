<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Services\ApiAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $service;

    public function __construct(ApiAuthService $service)
    {
        $this->service = $service;
    }
    public function loginUser(LoginRequest $request): JsonResponse{
        $data = $request->validated();

        if ($tokenResponse = $this->service->loginUser($data)) {
            return response()->json($tokenResponse);
        }

        return response()->json(['statusCode' => 401, 'errors' => "Error"], 401);

    }
    public function registerUser(RegisterUserRequest $request) : JsonResponse{
        $data = $request->validated();
        $user = $this->service->registerUser($data);
        return response()->json(['message' => 'your account created successfully,please wait for activation']);

    }
    public function logout():JsonResponse{
        $this->service->logout();
        return response()->json(['message' => '“Logged out successfully']);
    }

}
