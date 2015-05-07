<?php

namespace utils;

class Utils
{
    const PREFIX = '21bbb820-12fa-11e1-b96f-0002a5d5c51b';

    public static function print_pre($s)
    {
        print "<pre>";
        print_r($s);
        print "</pre>";
    }

    public static function getMessage($code)
    {
        return $GLOBALS['i18n']['sys'][$code];
    }

    public static function redirect($location)
    {
        header("Location: {$location}", true, 302);
    }

    public static function redirectToHome()
    {
        header("Location: http://" . __CONFIG_NM_HOST__ . "/", true, 302);
    }

    public static function sendError($message)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            self::json(array(
                'message' => $message
            ));
        } else {
            echo $message;
            exit;
        }
    }

    public static function mailTemplate($to, $subject, $message, $name = "Friend")
    {
        $subject = "Noisymap: {$subject}";
        $view = new \common\View();
        $view->setModel(
            array(
                'subject' => $subject,
                'message' => $message,
                'name' => $name
            ));
        $m = $view->fetch('mail/main.tpl');
        return @mail($to, $subject, $m, self::getHeaders());
    }

    private static function getHeaders()
    {
        $headers = "From: notification@noisymap.com\r\n" .
            "Reply-To: notification@noisymap.com\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;" . "\r\n";
        return $headers;
    }

    public static function json($value)
    {
        echo json_encode($value);
    }

    public static function genPass($text)
    {
        return md5(self::PREFIX . $text);
    }

    public static function genHash($params)
    {
        $result = '';
        foreach ($params as $value) {
            $result .= sha1($value);
        }
        return sha1(self::PREFIX . $result);
    }

    public static function genUuid($len = 8)
    {
        $hex = md5(self::PREFIX . uniqid(rand(), true));

        $pack = pack('H*', $hex);
        $tmp = base64_encode($pack);

        // $uid = preg_replace("#(*UTF8)[^A-Za-z0-9]#", "", $tmp);
        $uid = preg_replace("#[^A-Za-z0-9]#", "", $tmp);

        $len = max(4, min(128, $len));

        while (strlen($uid) < $len) {
            $uid .= self::genUuid(22);
        }

        return substr($uid, 0, $len);
    }

    public static function get_ip()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']) && self::validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }

        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $list = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($list as $ip) {
                if (self::validate_ip($ip)) {
                    return $ip;
                }
            }
        }

        if (!empty($_SERVER['HTTP_X_FORWARDED']) && self::validate_ip($_SERVER['HTTP_X_FORWARDED']))
            return $_SERVER['HTTP_X_FORWARDED'];
        if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && self::validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
            return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && self::validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
            return $_SERVER['HTTP_FORWARDED_FOR'];
        if (!empty($_SERVER['HTTP_FORWARDED']) && self::validate_ip($_SERVER['HTTP_FORWARDED']))
            return $_SERVER['HTTP_FORWARDED'];

        return $_SERVER['REMOTE_ADDR'];
    }

    public static function validate_ip($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
            return false;
        }

        //        self::$ip = ip2long($ip);
        return true;
    }

    /**
     * Recursive directory creation based on full path.
     *
     * Will attempt to set permissions on folders.
     *
     * @since 2.0.1
     *
     * @param string $target Full path to attempt to create.
     * @return bool Whether the path was created or not. True if path already exists.
     */
    public static function mkdir_p($target)
    {
        // from php.net/mkdir user contributed notes
        $target = str_replace('//', '/', $target);
        if (file_exists($target))
            return @is_dir($target);

        // Attempting to create the directory may clutter up our display.
        if (@mkdir($target)) {
            $stat = @stat(dirname($target));
            $dir_perms = $stat['mode'] & 0007777; // Get the permission bits.
            @chmod($target, $dir_perms);
            return true;
        } elseif (is_dir(dirname($target))) {
            return false;
        }

        // If the above failed, attempt to create the parent node, then try again.
        if (($target != '/') && (self::mkdir_p(dirname($target))))
            return self::mkdir_p($target);

        return false;
    }
}
