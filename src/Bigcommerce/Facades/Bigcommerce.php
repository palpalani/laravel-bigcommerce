<?php

declare(strict_types=1);

namespace Oseintow\Bigcommerce\Facades;

use Illuminate\Support\Facades\Facade;

class Bigcommerce extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'bigcommerce';
    }
}
