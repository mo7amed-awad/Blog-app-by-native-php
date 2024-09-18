<?php
/**
 * encrypt used to encrypt plain text
 * @param string $value
 * @return string
 */
if(!function_exists('encrypt'))
{
    function encrypt($value):string
    {
        $cipher=config('session.encryption_mode');
        $key=config('session.encryption_key');
        $ivlen=openssl_cipher_iv_length($cipher);
        $iv=openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw=openssl_encrypt($value,$cipher,$key,OPENSSL_RAW_DATA,$iv);
        $hmac=hash_hmac('sha256',$ciphertext_raw,$key,true);
        $ciphertext=base64_encode($iv.$hmac.$ciphertext_raw);
        return $ciphertext;
    }
}


if(!function_exists('decrypt'))
{
    function decrypt($ciphertext):string
    {
        $cipher=config('session.encryption_mode');
        $key=config('session.encryption_key');
        $convert=base64_decode($ciphertext);
        $ivlen=openssl_cipher_iv_length($cipher);
        $iv=substr($convert,0,$ivlen);
        $hmac=substr($convert,$ivlen,32);
        $ciphertext_raw=substr($convert,$ivlen+32);
        $original_text=openssl_decrypt($ciphertext_raw,$cipher,$key,OPENSSL_RAW_DATA,$iv);
        $calcmac=hash_hmac('sha256',$ciphertext_raw,$key,true);
        if(hash_equals($hmac,$calcmac))
        {
            return($original_text);
        }
        return "";
    }
}