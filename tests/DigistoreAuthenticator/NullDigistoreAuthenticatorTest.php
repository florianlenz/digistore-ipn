<?php

namespace tests\DigistoreAuthenticator;

use DigistoreIpn\DigistoreAuthenticator\NullDigistoreAuthenticator;
use PHPUnit\Framework\TestCase;

class NullDigistoreAuthenticatorTest extends TestCase
{
    public function testAuthenticator()
    {
        $nullDigistoreAuthenticator = new NullDigistoreAuthenticator();
        $this->assertTrue($nullDigistoreAuthenticator->auth('i_am_irrelevant', []));
    }
}