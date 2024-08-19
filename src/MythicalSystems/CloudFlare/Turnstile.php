<?php
namespace MythicalSystems\CloudFlare;
 /**
  * @package MythicalSystems\Utils
  * 
  * The CloudFlare Turnstile validator!
  */
class TurnStile
{
    public static function validate(string $response, string $ip, string $secret_key): int
    {
        $data = array(
            "secret" => $secret_key,
            "response" => $response,
            "remoteip" => $ip
        );

        $verify = "https://challenges.cloudflare.com/turnstile/v0/siteverify";
        $options = array(
            "http" => array(
                "header" => "Content-Type: application/x-www-form-urlencoded\r\n",
                "method" => "POST",
                "content" => http_build_query($data)
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($verify, false, $context);

        if ($result == false) {
            return false;
        }

        $result = json_decode($result, true);

        return $result["success"];
    }
}
?>