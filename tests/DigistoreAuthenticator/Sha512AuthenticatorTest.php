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
            'sha_sign' => '8a5b8b4611dee46b3daf3531fabb2a73a93a2be376eaa240dc115dd5818bd24a533eeee9a46aaa27c8064516e489e60b75533506e774e1979228428c910af275'
        ];

        $isAuth = $sha512Auth->auth('testPassword', $requestData);

        $this->assertTrue($isAuth);
    }

    public function testExceptionWrongShaSign()
    {
        $this->expectException(AccessDeniedException::class);

        $sha512Auth = new Sha512Authenticator();

        $requestData = [
            'sha_sign' => 'fake_sign'
        ];

        $isAuth = $sha512Auth->auth('testPassword', $requestData);

        $this->assertTrue($isAuth);
    }

}