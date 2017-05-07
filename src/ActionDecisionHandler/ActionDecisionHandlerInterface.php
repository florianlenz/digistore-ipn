<?php

namespace DigistoreIpn\ActionDecisionHandler;

use Psr\Log\LoggerInterface;

interface ActionDecisionHandlerInterface
{
    public function setLogger(LoggerInterface $logger);

    public function handle(array $requestData, array $eventHandlers);
}