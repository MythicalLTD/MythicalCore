<?php 
namespace MythicalSystems\Utils;

/**
 * @package MythicalSystems\Utils
 * 
 * The EncryptionHandler!
 */
class EncryptionHandler {

    /**
     * Encrypt the data specified
     * 
     * @param string|array $data The data that should be encrypted!
     * @param string $key The key you want to encrypt the data with!
     * 
     * @return string|array The encrypted data!
     */
    public static function encrypt(string|array $data, string $key) : string|array {
        $encrypted = '';

        $keyLength = strlen($key);

        for ($i = 0; $i < strlen($data); $i++) {
            $keyChar = $key[$i % $keyLength];
            $encrypted .= chr((ord($data[$i]) + ord($keyChar)) % 256);
        }

        return base64_encode($encrypted);
    }
    /**
     * Decrypt the data specified
     * 
     * @param string|array $data the data that should be decrypted!
     * @param string $key The key you want to decrypt the data with!
     * 
     * @return string|array The decrypted data!
     */
    public static function decrypt(string|array $data, string $key) : string|array
    {
        $encryptedData = base64_decode($data);
        $decrypted = '';
        $keyLength = strlen($key);

        for ($i = 0; $i < strlen($encryptedData); $i++) {
            $keyChar = $key[$i % $keyLength];
            $decrypted .= chr((ord($encryptedData[$i]) - ord($keyChar) + 256) % 256);
        }

        return $decrypted;
    }
}
?>