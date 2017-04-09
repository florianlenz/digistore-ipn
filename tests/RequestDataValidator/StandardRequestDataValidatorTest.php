<?php

namespace tests\RequestDataValidator;

use PHPUnit\Framework\TestCase;
use RequestDataValidator\StandardRequestDataValidator;
use Exceptions\MissingDataException;

class StandardRequestDataValidatorTest extends TestCase
{
    public function testSuccess()
    {
        $dataValidator = new StandardRequestDataValidator();

        $valid = $dataValidator->validate(
            [
                'order_id' => 34523,
                'product_id' => 1345,
                'email' => 'me@myname.me',
                'event' => 'on_payment',
                'sha_sign' => 'i_am_a_sha_string'
            ]
        );

        $this->assertTrue($valid);
    }

    public function testExceptionMissingParameter()
    {
        $this->expectException(MissingDataException::class);

        $dataValidator = new StandardRequestDataValidator();

        $valid = $dataValidator->validate(
            [
                'order_id' => 34523,
                'product_id' => 1345
            ]
        );
    }

}