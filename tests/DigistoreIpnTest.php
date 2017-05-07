<?php

namespace tests;

use DigistoreIpn\DigistoreAuthenticator\NullDigistoreAuthenticator;
use DigistoreIpn\DigistoreEvents;
use DigistoreIpn\DigistoreIpn;
use DigistoreIpn\Exceptions\MissingEventhandlerException;
use DigistoreIpn\RequestDataValidator\NullRequestDataValidator;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

class DigistoreIpnTest extends TestCase
{
    /**
     * Test exception for missing event
     */
    public function testMissingEvent()
    {
        $this->expectException(MissingEventhandlerException::class);

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