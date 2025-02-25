<?php

namespace App\Exceptions;

use Exception;
use App\ApiResponse;
use Symfony\Component\HttpFoundation\Response;

class NotFoundException extends Exception
{
    use ApiResponse;
    //
    public function __construct($message)
    {
        $message = null ? 'No Result found' : $message;
        parent::__construct($message);        
    }

    public function render()
    {
        return $this->error($this->getMessage(), Response::HTTP_NOT_FOUND);
    }
}
