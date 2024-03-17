<?php

namespace MythicalSystems\Api;

class ResponseHandler
{

    /**
     * Return a 200 response
     *
     * @param string|null $message
     * 
     * @return void Returns a void so nothing it will die!
     */
    public static function OK(string|null $message): void
    {
        self::sendManualResponse(200, null,$message);
    }

    /**
     * Return a 201 response
     *
     * @param string|null $message
     * 
     * @return void Returns a void so nothing it will die!
     */
    public static function Created(string|null $message): void
    {
        self::sendManualResponse(201, "The request has been fulfilled and a new resource has been created.", $message);
    }

    /**
     * Return a 204 response
     *
     * @param string|null $message
     * 
     * @return void Returns a void so nothing it will die!
     */
    public static function NoContent(string|null $message): void
    {
        self::sendManualResponse(204, "The server has successfully fulfilled the request and there is no content to send in the response.",$message);
    }

    /**
     * Return a 400 response
     *
     * @param string|null $message
     * 
     * @return void Returns a void so nothing it will die!
     */
    public static function BadRequest(string|null $message): void
    {
        self::sendManualResponse(400, "The server cannot process the request due to a client error (e.g., malformed syntax).",$message);
    }

    /**
     * Return a 401 response
     *
     * @param string|null $message
     * 
     * @return void Returns a void so nothing it will die!
     */
    public static function Unauthorized(string|null $message): void
    {
        self::sendManualResponse(401, "The client must authenticate itself to get the requested response.",$message);
    }

    /**
     * Return a 403 response
     *
     * @param string|null $message
     * 
     * @return void Returns a void so nothing it will die!
     */
    public static function Forbidden(string|null $message): void
    {
        self::sendManualResponse(403, "The server understood the request, but refuses to authorize it.",$message);
    }

    /**
     * Return a 404 response
     *
     * @param string|null $message
     * 
     * @return void Returns a void so nothing it will die!
     */
    public static function NotFound(string|null $message): void
    {
        self::sendManualResponse(404, "The requested resource could not be found on the server.",$message);
    }

    /**
     * Return a 405 response
     *
     * @param string|null $message
     * 
     * @return void Returns a void so nothing it will die!
     */
    public static function MethodNotAllowed(string|null $message): void
    {
        self::sendManualResponse(405, "The method specified in the request is not allowed for the resource identified by the request URI.",$message);
    }

    /**
     * Return a 500 response
     *
     * @param string|null $message
     * 
     * @return void Returns a void so nothing it will die!
     */
    public static function InternalServerError(string|null $message): void
    {
        self::sendManualResponse(500, "A generic error message, given when an unexpected condition was encountered and no more specific message is suitable.",$message);
    }
    /**
     * Return a 502 response
     *
     * @param string|null $message
     * 
     * @return void Returns a void so nothing it will die!
     */
    public static function BadGateway(string|null $message): void
    {
        self::sendManualResponse(502, "The server, while acting as a gateway or proxy, received an invalid response from the upstream server it accessed in attempting to fulfill the request.",$message);
    }
    /**
     * Return a 503 response
     *
     * @param string|null $message
     * 
     * @return void Returns a void so nothing it will die!
     */
    public static function ServiceUnavailable(string|null $message): void
    {
        self::sendManualResponse(503, "The server is currently unable to handle the request due to temporary overloading or maintenance of the server.",$message);
    }
    
    /**
     * Return a manual response code!
     * 
     * @param int $code The http code
     * @param string|null $error If you want to show any errors
     * @param string|null $message Any message you want to tell the user?
     * 
     * @return void
     */
    public static function sendManualResponse(int $code, string|null $error, string|null $message): void
    {
        $response = [
            "code" => $code,
            "error" => $error,
            "message" => $message
        ];

        http_response_code($code);
        die(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}