<?php

namespace App\Repositories;

use App\Repositories\Contracts\AuthenticateRepositoryInterface;
use App\Exceptions\AuthenticationException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticateRepository implements AuthenticateRepositoryInterface
{
    public function register(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'password' => Hash::make($data['password']),
        ]);

    }

    public function login(array$data)
    {;
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw new AuthenticationException('Invalid credentials');
        }
        return $user;
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}