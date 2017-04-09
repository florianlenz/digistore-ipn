<?php

namespace DigistoreAuthenticator;

use Exceptions\AccessDeniedException;

class Sha512Authenticator implements DigistoreAuthenticatorInterface
{
    public function auth(string $plainDsPassword, array $requestData) : bool
    {
        $dsShaSign = $requestData['sha_sign'];

        if($dsShaSign !== hash('sha512', $plainDsPassword)){
            throw new AccessDeniedException();
        }

        return true;

    }
}