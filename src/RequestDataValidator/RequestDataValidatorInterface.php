<?php

namespace RequestDataValidator;

interface RequestDataValidatorInterface
{
    public function validateRequestData(array $data);
}