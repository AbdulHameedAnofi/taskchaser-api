<?php

namespace App\Exceptions;

use Exception;
use App\ApiResponse;
use Symfony\Component\HttpFoundation\Response;
class AuthenticationException extends Exception
{
    use ApiResponse;
    //
    public function __construct($message)
    {
        $message = null ? 'Unauthorized' : $message;
        parent::__construct($message);        
    }

    public function render()
    {
        return $this->error($this->getMessage(), Response::HTTP_UNAUTHORIZED);
    }
}
