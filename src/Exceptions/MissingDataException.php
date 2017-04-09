<?php

namespace Exceptions;

class MissingDataException extends \Exception
{
    /**
     * MissingDataException constructor.
     * @param string $parameterKey
     */
    public function __construct(string $parameterKey)
    {
        parent::__construct(sprintf('The parameter: "%s" was not found in the digistore request', $parameterKey));
    }
}