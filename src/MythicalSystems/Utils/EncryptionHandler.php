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

    /**
     * Check if the encryption key is strong
     * 
     * @param string $key The key
     * 
     * @return bool 
     */
    public static function checkIfStrongKey(string $key): bool
    {
        $min_length = 8;
        if (strlen($key) <= $min_length) {
            return false;
        }
        if (
            !preg_match('/[A-Z]/', $key) ||
            !preg_match('/[a-z]/', $key) ||
            !preg_match('/[0-9]/', $key) ||
            !preg_match('/[^A-Za-z0-9]/', $key)
        ) {
            return false;
        }

        return true;
    }

    /**
     * Generate a random encryption key that can be used
     * 
     * @param int $length The length of the key (default is 12)
     * 
     * @return string The key
     * 
     * @throws \Exception
     */
    public static function generateKey(int $length = 12): string
    {
        if ($length <= 8) {
            throw new \Exception('The length has to be bigger then 8!');
        }
        
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        $special_chars = '!@#$%^&*()-_+=~`[]{}|;:,.<>?';

        $password = '';

        $password .= substr(str_shuffle($uppercase), 0, 1);
        $password .= substr(str_shuffle($lowercase), 0, 1);
        $password .= substr(str_shuffle($numbers), 0, 1);
        $password .= substr(str_shuffle($special_chars), 0, 1);
        $password .= substr(str_shuffle($uppercase . $lowercase . $numbers . $special_chars), 0, $length - 4);

        $password = str_shuffle($password);
        
        return (string)$password;
    }
}
