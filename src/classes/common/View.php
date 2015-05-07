<?php

namespace common;

use \smarty\SmartyWrapper;
use \utils\Languages;
use \utils\Users;

class View
{

    private static $smarty;

    function __construct()
    {
        self::$smarty = new SmartyWrapper();
        self::$smarty->assign('DIC', $GLOBALS['i18n']);
        self::$smarty->assign('USER', Users::getSessionUser());
    }

    public function setModel($map)
    {
        foreach ($map as $key => $value) {
            self::$smarty->assign($key, $value);
        }
    }

    public function display($template)
    {
        self::$smarty->display($template);
    }

    public function fetch($template)
    {
        return self::$smarty->fetch($template);
    }
}
