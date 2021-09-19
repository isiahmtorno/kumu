<?php

declare(strict_types=1);

namespace App\GitHub\Facade;

use Illuminate\Support\Facades\Facade;

class GitHub extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'github';
    }
}
