<?php
namespace MythicalSystems\Api;

class Api extends ResponseHandler
{
    /**
     * Init the api endpoint!
     * 
     * @return void
     */
    public static function init(): void
    {
        header('Content-type: application/json');
        ini_set("display_errors", 0);
        ini_set("display_startup_errors", 0);
    }

    /**
     * Get the authorization key from header
     * 
     * @return string|null Return the content of the Authorization header if given!!
     */
    public static function getAuthorizationHeader(): string|null
    {
        $headers = getallheaders();
        if (isset($headers['Authorization']) && !$headers['Authorization'] == null) {
            return ($headers['Authorization']);
        } else {
            return null;
        }
    }

    /**
     * Allow only POST requests
     * 
     * @return void
     */
    public static function allowOnlyGET(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            ResponseHandler::MethodNotAllowed("Please use a GET request to access this endpoint!", null);
        }
    }

    /**
     * Allow only POST requests
     * 
     * @return void
     */
    public static function allowOnlyPOST(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            ResponseHandler::MethodNotAllowed("Please use a POST request to access this endpoint!",null);
        }
    }
    /**
     * Allow only PUT requests
     * 
     * @return void
     */
    public static function allowOnlyPUT(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
            ResponseHandler::MethodNotAllowed("Please use a PUT request to access this endpoint!",null);
        }
    }

    /**
     * Allow only PATCH requests
     * 
     * @return void
     */
    public static function allowOnlyPATCH(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'PATCH') {
            ResponseHandler::MethodNotAllowed("Please use a PATCH request to access this endpoint!", null);
        }
    }
    /**
     * Allow only DELETE requests
     * 
     * @return void
     */
    public static function allowOnlyDELETE(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            ResponseHandler::MethodNotAllowed("Please use a DELETE request to access this endpoint!",null);
        }
    }

    /**
     * Allow only OPTIONS requests
     * 
     * @return void
     */
    public static function allowOnlyOPTIONS(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'OPTIONS') {
            ResponseHandler::MethodNotAllowed("Please use a OPTIONS request to access this endpoint!",null);
        }
    }

    /**
     * Allow only HEAD requests
     * 
     * @return void
     */
    public static function allowOnlyHEAD(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'HEAD') {
            ResponseHandler::MethodNotAllowed("Please use a HEAD request to access this endpoint!",null);
        }
    }

    public static function allowOnly(Methods $method) {
        if ($_SERVER['REQUEST_METHOD'] !== $method) {
            ResponseHandler::MethodNotAllowed("Please use a " . $method . " request to access this endpoint!",null);
        }
    }

    /**
     * Get the request method
     * 
     * @return string|null|array
     */
    public static function getRequestMethod() : string|null|array {
        if ($_SERVER['REQUEST_METHOD'] == null) {
            return null;
        } else if ($_SERVER['REQUEST_METHOD'] == "") {
            return null;
        }
        else {
            return $_SERVER['REQUEST_METHOD'];
        }
    }
}