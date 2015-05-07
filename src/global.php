<?php

if (isset($_POST['PHPSESSID'])) {
    session_id($_POST['PHPSESSID']);
}

session_start();

define('DS', DIRECTORY_SEPARATOR);

define('DIR_COMPILE', __DIR__ . str_replace('/', DS, '/../temp/compile'));
define('DIR_TEMPLATES', __DIR__ . DS . 'templates');
define('DIR_i18n', __DIR__ . DS . 'i18n');
define('DIR_RESOURCES', __DIR__ . str_replace('/', DS, '/../web/resources'));

$iPod = stripos($_SERVER['HTTP_USER_AGENT'], 'iPod');
$iPhone = stripos($_SERVER['HTTP_USER_AGENT'], 'iPhone');
$iPad = stripos($_SERVER['HTTP_USER_AGENT'], 'iPad');

define('IS_MOBILE', $iPod || $iPhone || $iPad);

ini_set("error_reporting", E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE & ~E_WARNING);

include('classes/utils/emoji.php');

function classes_autoload($class_name)
{
    $class = __DIR__ . DS . 'classes' . DS . str_replace('\\', DS, $class_name) . '.php';
    if (file_exists($class)) {
        /** @noinspection PhpIncludeInspection */
        require_once ($class);
        return true;
    } else {
        return false;
    }

}

spl_autoload_register('classes_autoload');

\utils\Languages::load_i18n();
\utils\Users::load();
