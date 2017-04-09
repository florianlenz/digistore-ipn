<?php

namespace DigistoreIpn;

use ActionDecisionHandler\ActionDecisionHandler;
use ActionDecisionHandler\ActionDecisionHandlerInterface;
use DigistoreAuthenticator\DigistoreAuthenticatorInterface;
use DigistoreAuthenticator\NullDigistoreAuthenticator;
use EventHandler\EventHandlerInterface;
use Psr\Log\LoggerInterface;
use RequestDataValidator\NullRequestDataValidator;
use RequestDataValidator\RequestDataValidatorInterface;
use Exceptions\MissingEventhandler;

final class DigistoreIpn
{

    /**
     * @var DigistoreAuthenticatorInterface
     */
    private $digistoreAuthenticator;

    /**
     * @var RequestDataValidatorInterface
     */
    private $requestDataValidator;

    /**
     * @var array
     */
    private $requestData;

    /**
     * @var ActionDecisionHandlerInterface
     */
    private $actionDescisionHandler;

    /**
     * @var string
     */
    private $shaSign;

    /**
     * @var array
     */
    private $eventHandler = [];

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * DigistoreIpn constructor.
     * @param LoggerInterface $logger
     * @param string $shaSign
     * @param array $requestData
     */
    public function __construct(LoggerInterface $logger, string $shaSign, array $requestData)
    {
        $this->shaSign = $shaSign;
        $this->requestData = $requestData;
        $this->logger = $logger;
        $this->actionDescisionHandler = new ActionDecisionHandler();
        $this->digistoreAuthenticator = new NullDigistoreAuthenticator();
        $this->requestDataValidator = new NullRequestDataValidator();
        $this->actionDescisionHandler->setLogger($logger);
    }

    /**
     * @param DigistoreAuthenticatorInterface $authenticator
     * @return DigistoreIpn
     */
    public final function setDigistoreAuthenticator(DigistoreAuthenticatorInterface $authenticator) : self
    {
        $this->digistoreAuthenticator = $authenticator;

        return $this;
    }

    /**
     * @param string $eventName
     * @param EventHandlerInterface $eventHandler
     * @return DigistoreIpn
     */
    public final function addEventHandler(string $eventName, EventHandlerInterface $eventHandler) : self
    {
        $this->eventHandler[$eventName] = $eventHandler;

        return $this;
    }


    public final function handle()
    {
        //Check if all events do exist
        foreach(DigistoreEvents::EVENTS as $dsEvent){
            if(false === array_key_exists($dsEvent, $this->eventHandler)){
                throw new MissingEventhandler($dsEvent);
            }
        }

        //Validate Digistore Request regarding sha sign
        $this->digistoreAuthenticator->auth($this->shaSign, $this->requestData);

        //Validate Data
        $this->requestDataValidator->validate($this->requestData);

        //Handle actions
        $this->actionDescisionHandler->handle($this->requestData, $this->eventHandler);
    }

}