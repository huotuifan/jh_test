<?php

namespace geo;

class GeoIp {
    public static function get_geo_record($ip) {
        require_once dirname(__FILE__) . '/geoipcity.inc';
        $gi = geoip_open(GEOIP_STANDARD);
        $record = geoip_record_by_addr($gi, $ip);
        geoip_close($gi);
        return $record;
    }
}
