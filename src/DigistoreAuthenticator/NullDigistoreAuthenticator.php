<?php

namespace DigistoreAuthentificator;

use Psr\Log\LoggerInterface;

class NullDigistoreAuthenticator implements DigistoreAuthenticatorInterface
{
    public function setLogger(LoggerInterface $loggerInterface)
    {

    }

    public function validate(string $shaSign, array $requestData)
    {

    }
}