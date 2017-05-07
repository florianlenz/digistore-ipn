<?php

namespace tests\Exceptions;

use DigistoreIpn\Exceptions\UnknownEventException;
use PHPUnit\Framework\TestCase;

class UnknownEventExceptionTest extends TestCase
{
    public function testErrorMessage()
    {
        $exception = new UnknownEventException('not_known');

        $this->assertEquals(
            'Got unknown event: "not_known"',
            $exception->getMessage()
        );
    }
}