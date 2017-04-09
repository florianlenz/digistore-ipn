<?php

namespace RequestDataValidator;

class NullRequestDataValidator implements RequestDataValidatorInterface
{
    public function validate(array $data)
    {
        return true;
    }
}