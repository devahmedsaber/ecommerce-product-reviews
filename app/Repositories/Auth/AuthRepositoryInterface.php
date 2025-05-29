<?php

namespace App\Repositories\Auth;

interface AuthRepositoryInterface
{
    public function register(array $data);
    public function login(array $data);
    public function logout();
    public function profile();
}
