<?php

namespace Exceptions;

class MissingEventhandler extends \Exception
{
    public function __construct(string $event)
    {
        parent::__construct(sprintf('No handler found for event: "%s"', $event));
    }
}