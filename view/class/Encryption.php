<?php

$cipher_algo = 'AES-256-CBC';

$key = 'Y5NPqWDu4vVAppWUxTxQ1ou9kgdeUgzM';

$iv_length = openssl_cipher_iv_length($cipher_algo);
$iv = openssl_random_pseudo_bytes($iv_length);

$options = 0;

$plaintext = readline('Enter some text:');
$ciphertext = openssl_encrypt($plaintext, $cipher_algo, $key, $options, $iv);

echo "Original string:  $plaintext\n";
echo  "Ciphertext: $ciphertext\n";

$decrypted = openssl_decrypt($ciphertext, $cipher_algo, $key, $options, $iv);

echo "Decrypted string:  $decrypted\n";

?>


