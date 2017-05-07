<?php

namespace tests\ActionDecisionHandler;

use ActionDecisionHandler\ActionDecisionHandler;
use DigistoreIpn\DigistoreEvents;
use EventHandler\EventHandler;
use EventHandler\NullEventHandler;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Exceptions\UnknownEventException;
use Psr\Log\NullLogger;

class ActionDecisionHandlerTest extends TestCase
{
    public function testException()
    {
        $this->expectException(UnknownEventException::class);
        $handler = new ActionDecisionHandler();
        $handler->handle(['event' => 'does_not_exist'], []);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testEvents(string $event)
    {
        $handler = new ActionDecisionHandler();
        $logger = $this->getMockBuilder(Logger::class)->disableOriginalConstructor()->getMock();
        $logger->expects($this->once())->method('debug');

        $handler->setLogger($logger);

        $handler->handle(['event' => $event, 'order_id' => '1234'], [$event => new EventHandler(function(){}, [])]);

    }

    public function dataProvider()
    {
        return [
            [DigistoreEvents::EVENT_ON_PAYMENT],
            [DigistoreEvents::EVENT_ON_CHARGEBACK],
            [DigistoreEvents::EVENT_LAST_PAID_DAY],
            [DigistoreEvents::EVENT_ON_REFUND],
            [DigistoreEvents::EVENT_ON_REBILL_CANCELLED],
            [DigistoreEvents::EVENT_ON_REBILL_RESUMED],
            [DigistoreEvents::EVENT_ON_PAYMENT_MISSED]
        ];
    }

}