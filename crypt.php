<?php
$keycrypt = "iqofj8645@'-&èihd";

function crypter($string, $encryption_key)
{
    $ciphering = "AES-128-CTR";
    $options = 0;

    $encryption_iv = '1234567891011121';

    $encryption = openssl_encrypt(
        $string,
        $ciphering,
        $encryption_key,
        $options,
        $encryption_iv
    );

    return $encryption;
}

function decrypter($encryption, $decryption_key)
{
    $decryption_iv = '1234567891011121';
    $ciphering = "AES-128-CTR";
    $options = 0;

    $decryption = openssl_decrypt(
        $encryption,
        $ciphering,
        $decryption_key,
        $options,
        $decryption_iv
    );

    // Display the decrypted string
    return $decryption;
}