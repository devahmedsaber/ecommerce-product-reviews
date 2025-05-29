<?php

namespace App\Services\Auth;

use App\Repositories\Auth\AuthRepositoryInterface;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(array $data)
    {
        return $this->authRepository->register($data);
    }

    public function login(array $data)
    {
        return $this->authRepository->login($data);
    }

    public function profile()
    {
        return $this->authRepository->profile();
    }

    public function logout()
    {
        return $this->authRepository->logout();
    }
}
