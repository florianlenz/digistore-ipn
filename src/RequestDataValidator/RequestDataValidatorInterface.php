<?php

namespace RequestDataValidator;

interface RequestDataValidatorInterface
{
    public function validate(array $data);
}