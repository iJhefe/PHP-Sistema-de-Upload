<?php


namespace Core\Cryptography;


class Encrypt
{

    private const DATA = CONFIG_GLOBAL['Cryptography'];
    private const METHOD = 'aes-256-cbc';

    public static function aes(string $str)
    {
        if (empty($str))
            return false;

        $iv_length = openssl_cipher_iv_length(self::METHOD);
        $iv = openssl_random_pseudo_bytes($iv_length);

        $first_encrypted = openssl_encrypt($str, self::METHOD, self::DATA['key'], OPENSSL_RAW_DATA ,$iv);
        $second_encrypted = hash_hmac('sha3-512', $first_encrypted, self::DATA['2key'], TRUE);

        return base64_encode($iv.$second_encrypted.$first_encrypted);

    }

}