<?php

namespace ILDaviz\LaravelPhpseclib\Exceptions;

use Exception;
use Throwable;

class BadLogin extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}