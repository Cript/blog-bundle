<?php

namespace Cript\BlogBundle\Context\User\Application\PostOrdering\Exception;

class PostOrderingException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
