<?php

namespace tests\DigistoreAuthenticator;

use DigistoreAuthenticator\NullDigistoreAuthenticator;
use PHPUnit\Framework\TestCase;

class NullDigistoreAuthenticatorTest extends TestCase
{
    public function testAuthenticator()
    {
        $nullDigistoreAuthenticator = new NullDigistoreAuthenticator();
        $this->assertTrue($nullDigistoreAuthenticator->auth('i_am_irrelevant', []));
    }
}