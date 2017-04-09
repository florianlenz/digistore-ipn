<?php

namespace DigistoreAuthenticator;

class NullDigistoreAuthenticator implements DigistoreAuthenticatorInterface
{
    public function auth(string $shaSign, array $requestData)
    {

    }
}