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

    public function login(array $credentials)
    {
        return $this->authRepository->login($credentials);
    }

    public function me()
    {
        return $this->authRepository->me();
    }

    public function logout()
    {
        return $this->authRepository->logout();
    }
}
