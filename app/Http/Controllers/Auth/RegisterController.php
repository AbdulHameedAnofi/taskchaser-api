<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Repositories\Contracts\AuthenticateRepositoryInterface;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct(protected AuthenticateRepositoryInterface $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function register(RegisterUserRequest $request)
    {
        try {
            $user = $this->authRepo->register($request->toArray());

            return $this->success(
                'User registered successfully',
                Response::HTTP_CREATED,
                $user
            );
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
