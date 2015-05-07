<?php
 
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../src/global.php';

$presenters = array(
    new \apps\index\Index(),
    new \apps\posts\Post(),
    new \apps\places\Place(),
    new \apps\users\User(),
    new \apps\accounts\Activate(),
    new \apps\hello\Hello(),
    new \apps\accounts\Forgot(),
);

$actions = array(
    new \actions\common\ActionLogin(),
    new \actions\common\ActionLogout(),
    new \actions\common\ActionReg(),
    new \actions\common\ActionSettings(),
    new \actions\post\ActionPost(),
    new \actions\post\ActionPostRec(),
    new \actions\post\ActionComment(),
    new \actions\post\ActionList(),
    new \actions\place\ActionSave(),
    new \actions\place\ActionSearch(),
    new \actions\place\ActionDelete(),
    new \actions\resource\ActionCheck(),
    new \actions\favorites\ActionUser(),
    new \actions\favorites\ActionPlace(),
    new \actions\post\ActionUpdate(),
    new \actions\post\ActionDelete(),
    new \actions\common\ActionForgotSend(),
    new \actions\common\ActionForgotChange(),
);

$router = new \common\Router();
$router->
    setPresenters($presenters)->
    setActions($actions)->
    start();

?>
