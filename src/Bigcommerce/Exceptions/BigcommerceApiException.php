<?php

declare(strict_types=1);

namespace Oseintow\Bigcommerce\Exceptions;

use Exception;

class BigcommerceApiException extends Exception
{
    /**
     * BigcommerceApiException constructor.
     * @param $message
     * @param int code
     */
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
    }
}
