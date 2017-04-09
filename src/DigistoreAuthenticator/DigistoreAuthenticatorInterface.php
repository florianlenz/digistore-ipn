<?php

namespace DigistoreAuthenticator;

interface DigistoreAuthenticatorInterface
{
    /**
     * @param string $shaSign
     * @param array $requestData
     * @return bool
     */
    public function auth(string $shaSign, array $requestData) : bool;
}