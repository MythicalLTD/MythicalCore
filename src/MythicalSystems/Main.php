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

    /**
     * Returns the main app url
     *
     * @return string
     */
    public static function getUrl(): string
    {
        $prot = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $svhost = $_SERVER['HTTP_HOST'];
        $appURL = $prot . '://' . $svhost;
        return $appURL;
    }
    

}
?>