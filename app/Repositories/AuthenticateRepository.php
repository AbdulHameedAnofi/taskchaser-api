<?php

namespace App\Repositories;

use App\Exceptions\AuthenticationException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticateRepository
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
    {

        if (!Auth::attempt($data)) {
            throw new AuthenticationException('Invalid credentials');
        }

        return Auth::user();
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}