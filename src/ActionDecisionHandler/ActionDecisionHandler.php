<?php

namespace ActionDecisionHandler;

use DigistoreIpn\DigistoreEvents;
use EventHandler\EventHandlerInterface;
use Exceptions\UnknownEventException;
use Psr\Log\LoggerInterface;

class ActionDecisionHandler implements ActionDecisionHandlerInterface
{

    /**
     * @var array
     */
    private $eventHandlers;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public final function handle(array $requestData, array $eventHandlers)
    {
        $this->eventHandlers = $eventHandlers;

        $dsEvent = $requestData['event'];

        if($dsEvent === DigistoreEvents::EVENT_ON_PAYMENT){
            $this->logMessage(DigistoreEvents::EVENT_ON_PAYMENT, $requestData);
            $this->getEventHandler(DigistoreEvents::EVENT_ON_PAYMENT)->handle($requestData);
        }elseif($dsEvent === DigistoreEvents::EVENT_ON_REFUND){
            $this->logMessage(DigistoreEvents::EVENT_ON_REFUND, $requestData);
            $this->getEventHandler(DigistoreEvents::EVENT_ON_REFUND)->handle($requestData);
        }elseif($dsEvent === DigistoreEvents::EVENT_ON_CHARGEBACK){
            $this->logMessage(DigistoreEvents::EVENT_ON_CHARGEBACK, $requestData);
            $this->getEventHandler(DigistoreEvents::EVENT_ON_CHARGEBACK)->handle($requestData);
        }elseif($dsEvent === DigistoreEvents::EVENT_ON_PAYMENT_MISSED){
            $this->logMessage(DigistoreEvents::EVENT_ON_PAYMENT_MISSED, $requestData);
            $this->getEventHandler(DigistoreEvents::EVENT_ON_PAYMENT_MISSED)->handle($requestData);
        }elseif($dsEvent === DigistoreEvents::EVENT_ON_REBILL_CANCELLED){
            $this->logMessage(DigistoreEvents::EVENT_ON_REBILL_CANCELLED, $requestData);
            $this->getEventHandler(DigistoreEvents::EVENT_ON_REBILL_CANCELLED)->handle($requestData);
        }elseif($dsEvent === DigistoreEvents::EVENT_ON_REBILL_RESUMED){
            $this->logMessage(DigistoreEvents::EVENT_ON_REBILL_RESUMED, $requestData);
            $this->getEventHandler(DigistoreEvents::EVENT_ON_REBILL_RESUMED)->handle($requestData);
        }elseif($dsEvent === DigistoreEvents::EVENT_LAST_PAID_DAY){
            $this->logMessage(DigistoreEvents::EVENT_LAST_PAID_DAY, $requestData);
            $this->getEventHandler(DigistoreEvents::EVENT_LAST_PAID_DAY)->handle($requestData);
        }else{
            throw new UnknownEventException($dsEvent);
        }
    }

    /**
     * @param $dsEvent
     * @return EventHandlerInterface
     */
    private function getEventHandler($dsEvent) : EventHandlerInterface
    {
        return $this->eventHandlers[$dsEvent];
    }

    /**
     * @param string $event
     * @param array $requestData
     */
    protected function logMessage(string $event, array $requestData)
    {
        $this->logger->debug(sprintf('Will handle Event: "%s". OrderId: "%S"', $event, $requestData['order_id']));
    }

}