<?php 
namespace MythicalSystems\Api;

class Api {
    
    /**
     * Init the api endpoint!
     * 
     * @return void
     */
    public static function init() : void {
        header('Content-type: application/json');
        ini_set("display_errors", 0);
        ini_set("display_startup_errors", 0);
    }

    /**
     * Get the authorization key from header
     * 
     * @return string|null Return the content of the Authorization header if given!!
     */
    public static function getAuthorizationHeader() : string|null {
        $headers = getallheaders();
        if (isset($headers['Authorization']) && !$headers['Authorization'] == null) {
            return($headers['Authorization']);
        } else {
            return null;
        }
    }
}