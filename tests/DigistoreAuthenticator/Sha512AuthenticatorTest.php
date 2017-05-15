<?php

namespace tests\DigistoreAuthenticator;

use DigistoreIpn\DigistoreAuthenticator\Sha512Authenticator;
use DigistoreIpn\Exceptions\AccessDeniedException;
use PHPUnit\Framework\TestCase;

class Sha512AuthenticatorTest extends TestCase
{
    public function testAuthenticatorSuccess()
    {
        $sha512Auth = new Sha512Authenticator();

        $requestData = [
            'parameter' => 'value',
            'sha_sign' => strtoupper(hash('sha512', "parameter=valuei_am_a_secure_password"))
        ];

        $isAuth = $sha512Auth->auth('i_am_a_secure_password', $requestData);

        $this->assertTrue($isAuth);
    }

    public function testExceptionWrongShaSign()
    {
        $this->expectException(AccessDeniedException::class);

        $sha512Auth = new Sha512Authenticator();

        $requestData = [
            'parameter' => 'value',
            'sha_sign' => strtoupper(hash('sha512', "parameter=valuei_am_a_secure_password"))
        ];

        //Password is different to the password which was used to create the sha_sign
        $isAuth = $sha512Auth->auth('password', $requestData);

        $this->assertTrue($isAuth);
    }

}