<?php

namespace DigistoreIpn\DigistoreAuthenticator;

use DigistoreIpn\Exceptions\AccessDeniedException;

class Sha512Authenticator implements DigistoreAuthenticatorInterface
{
    public function auth(string $plainDsPassword, array $requestData) : bool
    {
        $dsShaSign = $requestData['sha_sign'];

        $expectedShaSign = new DsShaFunction($plainDsPassword, $requestData);
        $expectedShaSign = $expectedShaSign->getHash();

        if($dsShaSign !== $expectedShaSign){
            throw new AccessDeniedException();
        }

        return true;

    }
}