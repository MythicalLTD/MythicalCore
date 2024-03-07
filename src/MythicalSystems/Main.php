<?php 
namespace MythicalSystems;

class Main {

    /**
     * Init the library
     * 
     * @return bool
     */
    public static function init() : bool {
         return true;
    }
    /**
     * Check if the connection is over https!
     * 
     * @return bool
     */
    public static function isHTTPS() : bool {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            return true;
        }
        return false;
    }
}
?>