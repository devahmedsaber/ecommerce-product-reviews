<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Http\Resources\Auth\UserDataResource;
use App\Http\Resources\Auth\UserProfileResource;
use App\Services\Auth\AuthService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponse;

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(UserRegisterRequest $request)
    {
        $data = $request->validated();

        $user = $this->authService->register($data);

        return $this->success('User Registered Successfully', new UserDataResource($user));
    }

    public function login(UserLoginRequest $request)
    {
        $credentials = $request->validated();

        $user = $this->authService->login($credentials);

        if (!$user) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return $this->success('User Logged In Successfully', new UserDataResource($user));
    }

    public function me()
    {
        $user = $this->authService->me();
        return $this->success('User Profile Retrieved', new UserProfileResource($user));
    }

    public function logout()
    {
        $this->authService->logout();
        return $this->success('User Logged Out Successfully');
    }
}
