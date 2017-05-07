<?php

namespace DigistoreIpn\RequestDataValidator;

use DigistoreIpn\Exceptions\MissingDataException;

final class StandardRequestDataValidator implements RequestDataValidatorInterface
{

    const REQUIRED_PARAMETER_KEYS = [
        'order_id',
        'product_id',
        'email',
        'event',
        'sha_sign'
    ];

    /**
     * @param array $data
     * @return bool
     * @throws MissingDataException
     */
    public final function validate(array $data) : bool
    {
        foreach(static::REQUIRED_PARAMETER_KEYS as $parameterKey){
            if(true !== array_key_exists($parameterKey, $data)){
                throw new MissingDataException($parameterKey);
            }
        }

        return true;
    }

}