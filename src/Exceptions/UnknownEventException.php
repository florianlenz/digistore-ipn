<?php

namespace DigistoreIpn\Exceptions;

class UnknownEventException extends \Exception
{
    public function __construct(string $event)
    {
        parent::__construct(sprintf('Got unknown event: "%s"', $event));
    }
}