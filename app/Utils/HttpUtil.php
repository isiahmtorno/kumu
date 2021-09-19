<?php

declare(strict_types=1);

namespace App\Utils;

use App\Utils\ResponseObject;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class HttpUtil
{
    public static function getRequest(string $url, array $params = []): object
    {
        $response = Http::get($url, $params);

        return self::responseParser($response);
    }

    private static function responseParser(Response $response): ResponseObject
    {
        return new ResponseObject($response->json(), $response->status());
    }
}
