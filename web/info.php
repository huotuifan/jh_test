<pre><?php

function genUuid($len = 8)
{
    $hex = md5('21bbb820-12fa-11e1-b96f-0002a5d5c51b' . uniqid(rand(), true));
//    echo "-{$hex}=<br>";
    $pack = pack('H*', $hex);
//    echo "-{$pack}=<br>";
    $tmp = base64_encode($pack);
//    echo "-{$tmp}=<br>";


//    mb_regex_encoding('UTF-8');

    $uid = preg_replace("#[^A-Za-z0-9]#", "", $tmp);
//    echo "-{$uid}=<br>";

    $len = max(4, min(128, $len));

    while (strlen($uid) < $len) {
        $uid .= genUuid(22);
    }

    return substr($uid, 0, $len);
}

for ($i = 0; $i < 1000; $i++) {
    echo genUuid(64)."<br>";
}

phpinfo();
