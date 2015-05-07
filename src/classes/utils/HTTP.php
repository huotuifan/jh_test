<?php

namespace utils;

use InvalidArgumentException;

class HTTP
{

    public static $codes = array(
        '100' => 'Continue',
        '101' => 'Switching Protocols',
        '200' => 'OK',
        '201' => 'Created',
        '202' => 'Accepted',
        '203' => 'Non-Authoritative Information',
        '204' => 'No Content',
        '205' => 'Reset Content',
        '206' => 'Partial Content',
        '300' => 'Multiple Choices',
        '301' => 'Moved Permanently',
        '302' => 'Found',
        '303' => 'See Other',
        '304' => 'Not Modified',
        '305' => 'Use Proxy',
        '307' => 'Temporary Redirect',
        '400' => 'Bad Request',
        '401' => 'Unauthorized',
        '402' => 'Payment Required',
        '403' => 'Forbidden',
        '404' => 'Not Found',
        '405' => 'Method Not Allowed',
        '406' => 'Not Acceptable',
        '407' => 'Proxy Authentication Required',
        '408' => 'Request Timeout',
        '409' => 'Conflict',
        '410' => 'Gone',
        '411' => 'Length Required',
        '412' => 'Precondition Failed',
        '413' => 'Request Entity Too Large',
        '414' => 'Request-URI Too Long',
        '415' => 'Unsupported Media Type',
        '416' => 'Requested Range Not Satisfiable',
        '417' => 'Expectation Failed',
        '500' => 'Internal Server Error',
        '501' => 'Not Implemented',
        '502' => 'Bad Gateway',
        '503' => 'Service Unavailable',
        '504' => 'Gateway Timeout',
        '505' => 'HTTP Version Not Supported',
    );

    private static $request;

    public static function pageNotFound() {
        self::status(404);
    }

    public static function status($code)
    {
        if ($code < 100 || $code > 599) {
            throw new InvalidArgumentException(sprintf('The HTTP status code "%s" is not valid.', $code));
        }

        header("HTTP/1.0 {$code} " . self::$codes[$code]);
    }

    public static function redirect($location, $code = 302)
    {
        header("Location: {$location}", true, $code);
    }

    public static function getRequest()
    {
        if (self::$request == null) {
            $pos = strpos($_SERVER['REQUEST_URI'], '?');
            if ($pos === false) {
                self::$request = $_SERVER['REQUEST_URI'];
            } else {
                self::$request = substr($_SERVER['REQUEST_URI'], 0, $pos);
            }
        }
        return self::$request;
    }
}
