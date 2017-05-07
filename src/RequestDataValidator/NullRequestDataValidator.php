<?php

namespace DigistoreIpn\RequestDataValidator;

class NullRequestDataValidator implements RequestDataValidatorInterface
{
    public function validate(array $data) : bool
    {
        return true;
    }
}