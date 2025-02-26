<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Repositories\Contracts\AuthenticateRepositoryInterface;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(protected AuthenticateRepositoryInterface $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function signin(LoginRequest $request)
    {
        try {
            $user = $this->authRepo->login($request->toArray());

            return $this->success(
                'User logged in successfully',
                Response::HTTP_OK, 
                [
                    "authorization" => [
                        'type' => "Bearer",
                        "token" => $user->createToken("ApiToken")->plainTextToken
                    ],
                    'user' => $user
                ]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
