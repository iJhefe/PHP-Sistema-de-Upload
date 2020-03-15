<?php


namespace Core\Cryptography;


class Decrypt
{

    private const DATA = CONFIG_GLOBAL['Cryptography'];
    private const METHOD = 'aes-256-cbc';

    public static function aes(string $cipher = '')
    {

        if (empty($cipher))
            return false;

        $mix = base64_decode($cipher);

        $iv_length = openssl_cipher_iv_length(self::METHOD);

        $iv = substr($mix,0,$iv_length);
        $second_encrypted = substr($mix,$iv_length,64);
        $first_encrypted = substr($mix,$iv_length+64);

        $data = openssl_decrypt($first_encrypted,self::METHOD, self::DATA['key'],OPENSSL_RAW_DATA,$iv);
        $second_encrypted_new = hash_hmac('sha3-512', $first_encrypted, self::DATA['2key'], TRUE);

        if (hash_equals($second_encrypted,$second_encrypted_new))
            return $data;

        return false;
    }

}