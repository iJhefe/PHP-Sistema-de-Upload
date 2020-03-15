<?php


namespace Core\Cryptography;


class JWT
{
    private const Config = CONFIG_GLOBAL['JWT'];

    /**
     * @param array $payload
     * @return string
     */
    public static function generate(array $payload) : string
    {

        $Encrypt = new Encrypt();

        $headers = [

            'created'   =>  $Encrypt->aes( time() ),
            'expires'   =>  $Encrypt->aes( strtotime('+' . self::Config['valid_time']) ),

        ];

        $real_payload = [];

        foreach ($payload as $key => $value)
        {

            $real_payload[] = $Encrypt->aes($key) . '#!#' . $Encrypt->aes($value);

        }

        $Token = implode('.', $headers);

        $Token .= '.' . implode('.', $real_payload);

        return $Token;
    }

    /**
     * @param string $token
     * @return array|bool
     */
    public static function token2data(string $token)
    {
        if (self::token_is_valid($token))
            return self::get_token_data($token);

        return false;
    }

    /**
     * @param string $token
     * @return bool
     */
    public static function token_is_valid(string $token) : bool
    {
        $dataToken = self::get_token_data($token);

        if (!$dataToken)
            return false;

        if ($dataToken['headers']['expires'] < time())
            return false;

        if ($dataToken['headers']['created'] > $dataToken['headers']['expires'])
            return false;

        if (count($dataToken['payloads']) < 1)
            return false;

        return true;
    }

    /**
     * @param string $token
     * @return array|bool
     */
    public static function get_token_data(string $token)
    {

        $exploded = explode('.', $token);

        if (count($exploded) < 1)
            return false;


        $Decrypt = new Decrypt();

        $Data = [

            'headers'   => [
                'created'   => $Decrypt->aes($exploded[0]),
                'expires'   => $Decrypt->aes($exploded[1])
            ]

        ];

        $payloads_names = [];

        for ($i = count($exploded) - 1; $i > 1; $i--)
        {

            $payloads_names[] = explode('#!#', $exploded[$i]);

        }

        $payloads = [];

        for ($i = count($payloads_names) - 1; $i >= 0; $i--)
        {

            $aux = $payloads_names[$i];

            $name = $Decrypt->aes( $aux[0] );

            $value = $Decrypt->aes( $aux[1] );

            if (!$name || !$value)
                return false;

            $payloads[$name] = $value;

        }

        $Data['payloads'] = $payloads;

        return $Data;

    }
}