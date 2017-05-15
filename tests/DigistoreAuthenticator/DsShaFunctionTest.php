<?php

namespace tests\DigistoreAuthenticator;

use DigistoreIpn\DigistoreAuthenticator\DsShaFunction;
use PHPUnit\Framework\TestCase;

class DsShaFunctionTest extends TestCase
{
    public function testShaFunction()
    {
        $requestParameter = [
            "parameter" => "value"
        ];

        $digistoreIpnPassword = "i_am_a_secure_password";

        $assertedHash = strtoupper(hash('sha512', "parameter=valuei_am_a_secure_password"));

        $dsShaFunction = new DsShaFunction($digistoreIpnPassword, $requestParameter);

        $this->assertEquals($assertedHash, $dsShaFunction->getHash());
    }
}