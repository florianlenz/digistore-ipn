<?php

namespace DigistoreIpn;

use ActionDecisionHandler\ActionDecisionHandler;
use ActionDecisionHandler\ActionDecisionHandlerInterface;
use DigistoreAuthenticator\DigistoreAuthenticatorInterface;
use DigistoreAuthenticator\Sha512Authenticator;
use EventHandler\EventHandlerInterface;
use Exceptions\MissingEventhandlerException;
use Psr\Log\LoggerInterface;
use RequestDataValidator\RequestDataValidatorInterface;
use RequestDataValidator\StandardRequestDataValidator;

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
    public final function __construct(LoggerInterface $logger, string $shaSign, array $requestData)
    {
        $this->shaSign = $shaSign;
        $this->requestData = $requestData;
        $this->logger = $logger;
        $this->actionDescisionHandler = new ActionDecisionHandler();
        $this->actionDescisionHandler->setLogger($logger);
        $this->digistoreAuthenticator = new Sha512Authenticator();
        $this->requestDataValidator = new StandardRequestDataValidator();
    }

    /**
     * @param DigistoreAuthenticatorInterface $authenticator
     * @return DigistoreIpn
     */
    public final function setAuthenticator(DigistoreAuthenticatorInterface $authenticator) : self
    {
        $this->digistoreAuthenticator = $authenticator;

        return $this;
    }

    /**
     * @param RequestDataValidatorInterface $validator
     * @return DigistoreIpn
     */
    public final function setDataValidator(RequestDataValidatorInterface $validator) : self
    {
        $this->digistoreAuthenticator = $validator;

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
                throw new MissingEventhandlerException($dsEvent);
            }
        }

        //Validate Digistore Request sha sign
        if(true !==  $this->digistoreAuthenticator->auth($this->shaSign, $this->requestData)){
            return;
        }

        //Validate request data
        if(true !== $this->requestDataValidator->validate($this->requestData)){
            return;
        }

        //Handle actions
        $this->actionDescisionHandler->handle($this->requestData, $this->eventHandler);
    }

}