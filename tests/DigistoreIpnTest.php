<?php

namespace tests;

use DigistoreAuthenticator\NullDigistoreAuthenticator;
use DigistoreIpn\DigistoreEvents;
use DigistoreIpn\DigistoreIpn;
use EventHandler\NullEventHandler;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;
use RequestDataValidator\NullRequestDataValidator;
use Exceptions\MissingEventhandlerException;

class DigistoreIpnTest extends TestCase
{
    /**
     * Test exception for missing event
     */
    public function testMissingEvent()
    {
        $this->expectException(MissingEventHandlerException::class);

        $dsIpn = new DigistoreIpn(new NullLogger(), '', []);
        $dsIpn->setAuthenticator(new NullDigistoreAuthenticator());
        $dsIpn->setDataValidator(new NullRequestDataValidator());

        $dsIpn->handle();
    }

    /**
     * Test adding of event handler
     */
    public function testAddEvents()
    {

        //Mock the null request data validator
        $nullRequestDataValidator = $this
            ->getMockBuilder(NullDigistoreAuthenticator::class)
            ->getMock();

        //Make it return false
        $nullRequestDataValidator->expects($this->once())
            ->method('auth')
            ->willReturn(false);

        $dsIpn = new DigistoreIpn(new NullLogger(), '', []);
        $dsIpn->setAuthenticator($nullRequestDataValidator);

        foreach(DigistoreEvents::EVENTS as $event){
            $dsIpn->addEventHandler($event, function(){}, []);
        }

        $dsIpn->handle();

    }

}