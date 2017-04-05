<?php

namespace DigistoreAuthentificator;

use Psr\Log\LoggerInterface;

interface DigistoreAuthenticatorInterface
{

    public function setLogger(LoggerInterface $loggerInterface);

    public function validate(string $shaSign, array $requestData);
}