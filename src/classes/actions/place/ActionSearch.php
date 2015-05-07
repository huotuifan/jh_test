<?php

namespace actions\place;

use \utils\Utils;
use \utils\Users;
use \db\DbUser;
use \db\DbPlace;

class ActionSearch extends \common\AjaxAction
{

    const NAME = 'place.search';

    function getName()
    {
        return self::NAME;
    }

    function execute()
    {
        $term = $this->getParamTrimmed('term');
        $filter = $this->getParamTrimmed('filter');
        $bounds = explode(',', $this->getParamTrimmed('bounds'));

        if ($filter === 'ffm') {
            $ffmPlaces = DbPlace::getFFMPlaces($bounds);
            $places = array();
            foreach ($ffmPlaces as $place) {
                $places[$place[DbPlace::UUID]] = $place;
            }
        } else {
            $places = DbPlace::searchByTerm($term);

            if (empty($filter)) {
                $suggest = $this->geocode($term);

                if (!empty($suggest)) {
                    $places = array_merge($places, $suggest);
                }
            }
        }

        Utils::json(array(
            'places' => $places
        ));
    }

    public function geocode($term)
    {
        $term = str_replace(" ", "+", urlencode($term));
        $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . $term . "&sensor=false";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $details_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = json_decode(curl_exec($ch), true);

        // If Status Code is ZERO_RESULTS, OVER_QUERY_LIMIT, REQUEST_DENIED or INVALID_REQUEST
        if ($response['status'] != 'OK') {
            return null;
        }

        $result = array();

        foreach ($response['results'] as $item) {
            $geometry = $item['geometry'];
            array_push($result, array(
                'place_name' => $item['formatted_address'],
                'place_lat' => $geometry['location']['lat'],
                'place_lng' => $geometry['location']['lng'],
                'viewport' => $geometry['viewport']
            ));
        }

        return $result;
    }

}
