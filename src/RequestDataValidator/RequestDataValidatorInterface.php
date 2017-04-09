<?php

namespace RequestDataValidator;

interface RequestDataValidatorInterface
{
    /**
     * @param array $data
     * @return bool
     */
    public function validate(array $data) : bool;
}