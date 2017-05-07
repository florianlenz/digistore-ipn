<?php

namespace tests\Exceptions;

use DigistoreIpn\Exceptions\AccessDeniedException;
use PHPUnit\Framework\TestCase;

class AccessDeniedExceptionTest extends TestCase
{
    public function testErrorMessage()
    {
        $exception = new AccessDeniedException();

        $this->assertEquals(
            'Access denied',
            $exception->getMessage()
        );
    }
}