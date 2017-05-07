<?php

namespace DigistoreIpn\DigistoreAuthenticator;

class NullDigistoreAuthenticator implements DigistoreAuthenticatorInterface
{
    public function auth(string $shaSign, array $requestData) : bool
    {
        return true;
    }
}