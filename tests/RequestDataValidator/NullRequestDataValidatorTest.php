<?php

namespace tests\RequestDataValidator;

use PHPUnit\Framework\TestCase;
use RequestDataValidator\NullRequestDataValidator;

class NullRequestDataValidatorTest extends TestCase
{
    public function testNullRequestDataValidator()
    {
        $nullRequestDataValidator = new NullRequestDataValidator();
        $this->assertTrue($nullRequestDataValidator->validate([]));
    }
}