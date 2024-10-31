<?php
namespace MythicalSystems\User;

class Session
{
    /**
     * Start or resume a session
     */
    public static function start(): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Destroy the current session
     */
    public static function destroy(): void
    {
        session_destroy();
    }

    /**
     * Set a session variable
     *
     * @param string $name The name of the session variable
     * @param mixed $value The value of the session variable
     * 
     * @return void
     */
    public static function set(string $name, $value): void
    {
        self::start();
        $_SESSION[$name] = $value;
    }

    /**
     * Get the value of a session variable
     *
     * @param string $name The name of the session variable
     * @return mixed|null The value of the session variable if it exists, null otherwise
     * 
     * @return null|string|array
     */
    public static function get(string $name) : null|string|array
    {
        self::start();
        return $_SESSION[$name] ?? null;
    }

    /**
     * Unset a session variable
     *
     * @param string $name The name of the session variable to unset
     * 
     * @return void
     */
    public static function unset(string $name): void
    {
        self::start();
        unset($_SESSION[$name]);
    }
}
