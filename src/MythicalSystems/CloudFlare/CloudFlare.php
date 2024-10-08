<?php

namespace MythicalSystems\CloudFlare;

class CloudFlare
{
    /**
     * Gets the real user ip 
     * 
     * @return string !! This value shall be SQLI protected on your side due to cloudflare not checking if the ips were modified by some headers !!
     */
    public static function getRealUserIP(): string
    {
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }

        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

        return (string) $ip;
    }

    /**
     * Check if the user is using cloudflare
     * 
     * @return bool
     */
    public static function isUsingCloudFlare(): bool
    {
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            return true;
        }
        return false;
    }
}
