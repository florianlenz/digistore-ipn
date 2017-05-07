<?php

namespace DigistoreIpn\ActionDecisionHandler;

use DigistoreIpn\DigistoreEvents;
use DigistoreIpn\EventHandler\EventHandler;
use DigistoreIpn\Exceptions\UnknownEventException;
use Psr\Log\LoggerInterface;

final class ActionDecisionHandler implements ActionDecisionHandlerInterface
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
    public final function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public final function handle(array $requestData, array $eventHandlers)
    {
        $this->eventHandlers = $eventHandlers;

        $dsEvent = $requestData['event'];

        switch($dsEvent){
            case DigistoreEvents::EVENT_ON_PAYMENT : {
                $this->logMessage(DigistoreEvents::EVENT_ON_PAYMENT, $requestData);
                $this->executeEvent(DigistoreEvents::EVENT_ON_PAYMENT);
                break;
            }
            case DigistoreEvents::EVENT_ON_REFUND : {
                $this->logMessage(DigistoreEvents::EVENT_ON_REFUND, $requestData);
                $this->executeEvent(DigistoreEvents::EVENT_ON_REFUND);
                break;
            }
            case DigistoreEvents::EVENT_ON_CHARGEBACK : {
                $this->logMessage(DigistoreEvents::EVENT_ON_CHARGEBACK, $requestData);
                $this->executeEvent(DigistoreEvents::EVENT_ON_CHARGEBACK);
                break;
            }
            case DigistoreEvents::EVENT_ON_PAYMENT_MISSED : {
                $this->logMessage(DigistoreEvents::EVENT_ON_PAYMENT_MISSED, $requestData);
                $this->executeEvent(DigistoreEvents::EVENT_ON_PAYMENT_MISSED);
                break;
            }
            case DigistoreEvents::EVENT_ON_REBILL_CANCELLED : {
                $this->logMessage(DigistoreEvents::EVENT_ON_REBILL_CANCELLED, $requestData);
                $this->executeEvent(DigistoreEvents::EVENT_ON_REBILL_CANCELLED);
                break;
            }
            case DigistoreEvents::EVENT_ON_REBILL_RESUMED : {
                $this->logMessage(DigistoreEvents::EVENT_ON_REBILL_RESUMED, $requestData);
                $this->executeEvent(DigistoreEvents::EVENT_ON_REBILL_RESUMED);
                break;
            }
            case DigistoreEvents::EVENT_LAST_PAID_DAY : {
                $this->logMessage(DigistoreEvents::EVENT_LAST_PAID_DAY, $requestData);
                $this->executeEvent(DigistoreEvents::EVENT_LAST_PAID_DAY);
                break;
            }
            default : {
                throw new UnknownEventException($dsEvent);
            }
        }
    }

    /**
     * @param $dsEvent
     * @return \Closure
     */
    private final function executeEvent(string $dsEvent)
    {
        /** @var EventHandler $eventHandler */
        $eventHandler = $this->eventHandlers[$dsEvent];

        call_user_func_array(
            $eventHandler->getEventHandler(),
            $eventHandler->getEventHandlerData()
        );
    }

    /**
     * @param string $event
     * @param array $requestData
     */
    protected final function logMessage(string $event, array $requestData)
    {
        $this->logger->debug(sprintf('Will handle Event: "%s". OrderId: "%S"', $event, $requestData['order_id']));
    }

}