<?php

namespace App\Repositories\Contracts;

interface AuthenticateRepositoryInterface
{
    public function register(array $data);

    public function login(array $data);

    public function logout();
}