<?php

namespace DigistoreIpn\DigistoreAuthenticator;

class DsShaFunction
{

    /**
     * @var array
     */
    private $requestData;

    /**
     * @var string
     */
    private $ipnPassphrase;

    /**
     * DsShaFunction constructor.
     * @param string $ipnPassphrase
     * @param array $requestData
     */
    public function __construct(string $ipnPassphrase, array $requestData)
    {
        $this->requestData = $requestData;
        $this->ipnPassphrase = $ipnPassphrase;
    }

    public function getHash()
    {
        $array = $this->requestData;
        $ipnPassphrase = $this->ipnPassphrase;

        unset($array[ 'sha_sign' ]);

        $keys = array_keys($array);
        sort($keys);

        $shaString = "";

        foreach ($keys as $key)
        {
            $value = html_entity_decode( $array[ $key ] );

            $isEmpty = !isset($value) || $value === "" || $value === false;

            if ($isEmpty)
            {
                continue;
            }

            $shaString .= "$key=$value$ipnPassphrase";
        }

        return strtoupper(hash("sha512", $shaString));
    }

}