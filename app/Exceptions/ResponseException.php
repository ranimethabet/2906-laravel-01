<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Traits\JsonResponseTrait;
use Illuminate\Http\JsonResponse;

class ResponseException extends Exception
{

    use JsonResponseTrait;


    /**
     * Report the exception.
     */
    public function report(): void
    {
        //
    }

    /**
     * Render the exception as an HTTP response.
     */
    public function render(Request $request): JsonResponse
    {
        return $this->error($this->getMessage(), $this->getCode());
    }
}
