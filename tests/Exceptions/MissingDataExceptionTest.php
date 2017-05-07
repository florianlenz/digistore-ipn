<?php

namespace tests\Exceptions;

use DigistoreIpn\Exceptions\MissingDataException;
use PHPUnit\Framework\TestCase;

class MissingDataExceptionTest extends TestCase
{
    public function testErrorMessage()
    {
        $exception = new MissingDataException('sha_sign');

        $this->assertEquals(
            'The parameter: "sha_sign" was not found in the digistore request',
            $exception->getMessage()
        );
    }
}