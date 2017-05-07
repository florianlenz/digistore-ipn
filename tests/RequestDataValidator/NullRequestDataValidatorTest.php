<?php

namespace tests\RequestDataValidator;

use DigistoreIpn\RequestDataValidator\NullRequestDataValidator;
use PHPUnit\Framework\TestCase;

class NullRequestDataValidatorTest extends TestCase
{
    public function testNullRequestDataValidator()
    {
        $nullRequestDataValidator = new NullRequestDataValidator();
        $this->assertTrue($nullRequestDataValidator->validate([]));
    }
}