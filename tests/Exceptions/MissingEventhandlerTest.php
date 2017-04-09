<?php

namespace tests\Exceptions;

use Exceptions\MissingEventhandlerException;
use PHPUnit\Framework\TestCase;

class MissingEventhandlerTest extends TestCase
{
    public function testErrorMessage()
    {
        $exception = new MissingEventhandlerException('on_payment');

        $this->assertEquals(
            'No handler found for event: "on_payment"',
            $exception->getMessage()
        );
    }
}