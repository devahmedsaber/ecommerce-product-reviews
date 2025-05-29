<?php

namespace App\Repositories\Auth;

use App\Exceptions\GeneralException;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthRepository implements AuthRepositoryInterface
{
    /**
     * User register.
     *
     * @param array $data
     * @return mixed
     */
    public function register(array $data)
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return $user;
    }

    /**
     * User login.
     *
     * @param array $credentials
     * @return mixed
     */
    public function login(array $credentials)
    {
        if (! auth()->attempt($credentials)) {
            throw new GeneralException(__('auth.failed'), 401);
        }

        return auth()->user();
    }

    public function me()
    {
        return auth()->user();
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
    }
}
