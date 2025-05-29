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
        return $this->success(__('auth.registered'), new UserDataResource($user));
    }

    public function login(UserLoginRequest $request)
    {
        $data = $request->validated();
        $user = $this->authService->login($data);
        return $this->success(__('auth.logged_in'), new UserDataResource($user));
    }

    public function profile()
    {
        $user = $this->authService->profile();
        return $this->success(__('auth.profile_retrieved'), new UserProfileResource($user));
    }

    public function logout()
    {
        $this->authService->logout();
        return $this->success(__('auth.logged_out'));
    }
}
