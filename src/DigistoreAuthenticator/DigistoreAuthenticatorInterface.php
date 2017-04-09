<?php

namespace DigistoreAuthenticator;

interface DigistoreAuthenticatorInterface
{
    public function auth(string $shaSign, array $requestData);
}