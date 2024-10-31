<?php

namespace MythicalSystems\User;

/**
 * @package MythicalSystems\User
 * 
 * The UUIDManager!
 */
class UUIDManager
{
    /**
     * Generate a UUID
     * 
     * @return string The generated UUID
     */
    public static function generateUUID(): string
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
    /**
     * Check if a UUID is valid
     * 
     * @param string $uuid The UUID to check
     * 
     * @return bool Is the UUID valid?
     */
    public static function isValidUUID(string $uuid): bool
    {
        return preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $uuid) === 1;
    }
    /**
     * Check if a UUID is valid
     * 
     * @param string $uuid The UUID to check
     * 
     * @return bool Is the UUID valid?
     */
    public static function isValidUUIDv4(string $uuid): bool
    {
        return preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $uuid) === 1;
    }

    /**
     * Get the UUID from a string
     * 
     * @param string $string The string to get the UUID from
     * 
     * @return string The UUID
     */
    public static function getUUIDFromString(string $string): string
    {
        $pattern = '/[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}/';
        preg_match($pattern, $string, $matches);
        return $matches[0];
    }

    /**
     * Get the UUID from a string
     * 
     * @param string $string The string to get the UUID from
     * 
     * @return string The UUID
     */
    public static function getUUIDFromStringv4(string $string): string
    {
        $pattern = '/[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}/';
        preg_match($pattern, $string, $matches);
        return $matches[0];
    }
}