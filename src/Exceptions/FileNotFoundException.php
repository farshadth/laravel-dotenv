<?php

namespace Farshadth\DotEnv\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class FileNotFoundException extends \Exception
{
    public function __construct(string $message = 'File not found', int $code = Response::HTTP_NOT_FOUND, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }


}