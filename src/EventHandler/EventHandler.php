<?php

namespace DigistoreIpn\EventHandler;

class EventHandler
{
    /**
     * @var \Closure
     */
    private $eventHandler;

    /**
     * @var array
     */
    private $eventHandlerData;

    /**
     * EventHandler constructor.
     * @param \Closure $eventHandler
     * @param array $closureUseData
     */
    public function __construct(\Closure $eventHandler, array $closureUseData)
    {
        $this->eventHandler = $eventHandler;
        $this->eventHandlerData = $closureUseData;
    }

    /**
     * @return \Closure
     */
    public function getEventHandler() : \Closure
    {
        return $this->eventHandler;
    }

    /**
     * @return array
     */
    public function getEventHandlerData() : array
    {
        return $this->eventHandlerData;
    }

}