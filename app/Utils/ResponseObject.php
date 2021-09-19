<?php

declare(strict_types=1);

namespace App\Utils;

use Illuminate\Http\Response;

class ResponseObject
{
    private const INVALIDARGUMENTEXCEPTION_CODE = 0;

    private $response;
    private $response_code;

    public function __construct($response = null, int $response_code = Response::HTTP_OK)
    {
        $this->response = $response;
        $this->response_code = $response_code;
    }

    public function getValue()
    {
        return $this->response;
    }

    public function getResponseCode(): int
    {
        if ($this->response_code === self::INVALIDARGUMENTEXCEPTION_CODE) {
            return Response::HTTP_INTERNAL_SERVER_ERROR;
        };

        return $this->response_code;
    }
}
