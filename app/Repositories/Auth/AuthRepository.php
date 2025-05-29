<?php

namespace App\Repositories\Auth;

use App\Exceptions\GeneralException;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthRepository implements AuthRepositoryInterface
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function register(array $data)
    {
        $user = $this->user->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'] ?? 'user',
            'password' => bcrypt($data['password']),
        ]);
        auth()->login($user);
        return $user;
    }

    public function login(array $data)
    {
        if (!auth()->attempt($data)) {
            throw new GeneralException(__('auth.failed'), 401);
        }
        return auth()->user();
    }

    public function profile()
    {
        return auth()->user();
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
    }
}
