<?php

namespace actions\common;

use \utils\Utils;
use \db\DbUser;

class ActionReg extends \common\AjaxAction
{

    const NAME = 'common.reg';

    function getName()
    {
        return self::NAME;
    }

    function execute()
    {

        $row = $this->parseModel();
        //$errors = $this->getFieldValues($row);

        if (!empty($errors)) {
            Utils::json(array(
                'message' => "Oops, something happened"
            ));
        } else {
            
            $ip = Utils::get_ip();
            $record = \geo\GeoIp::get_geo_record($ip);

            $row[DbUser::IP] = $ip;
            if (!empty($record->country_code)) {
                if (!empty($record->country_code)) {
                    $row[DbUser::COUNTRY] = $record->country_code;
                }
                if (!empty($record->city)) {
                    $row[DbUser::CITY] = $record->city;
                }
                $row[DbUser::LAT] = $record->latitude;
                $row[DbUser::LNG] = $record->longitude;
            }
            
            $id = DbUser::create($row);
            $session_key= $id[DbUser::KEY];
            $uuid= $id[DbUser::UUID];

            Utils::json(array(
                 self::STATUS => self::OK,
                 'session_key'    => "$session_key",
                 'user_id'   => "$uuid"
            ));
        }
    }

    private function parseModel()
    {
        return array(
            DbUser::NAME => trim($this->model['name']),
            DbUser::EMAIL => trim($this->model['email']),
            DbUser::PASS => trim($this->model['password']),
        );
    }

    private function getFieldValues(&$row)
    {
        $result = array();

        if (empty($row[DbUser::NAME])) {
            $result['elements']['ErrorMessage'] = Utils::getMessage('f001');
        } else if (strlen($row[DbUser::NAME]) > 64) {
            $result['elements']['ErrorMessage'] = Utils::getMessage('f022');
        }

        if (empty($row[DbUser::EMAIL])) {
            $result['elements']['ErrorMessage'] = Utils::getMessage('f001');
        } else if (strpos($row[DbUser::EMAIL], '@') === false) {
            $result['elements']['ErrorMessage'] = Utils::getMessage('f014');
        } else {
            $e = explode('@', $row[DbUser::EMAIL]);
            if (count($e) > 2) {
                $result['elements']['ErrorMessage'] = Utils::getMessage('f013');
            } else if (empty($e[0])) {
                $result['elements']['ErrorMessage'] = Utils::getMessage('f015');
            } else if (empty($e[1])) {
                $result['elements']['ErrorMessage'] = Utils::getMessage('f012');
            } else if (strlen($e[0]) > 64 || strlen($e[1]) > 255) {
                $result['elements']['ErrorMessage'] = Utils::getMessage('f017');
            } else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $e[1])) {
                $result['elements']['ErrorMessage'] = Utils::getMessage('f016');
            } else if (preg_match('/\\.\\./', $e[1])) {
                $result['elements']['ErrorMessage'] = Utils::getMessage('f016');
            } else {
                $v = true;
                if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\", "", $e[0]))) {
                    if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\", "", $e[0]))) {
                        $v = false;
                        $result['elements']['ErrorMessage'] = Utils::getMessage('f011');
                    }
                }
                if ($v && !(checkdnsrr($e[1], "MX") || checkdnsrr($e[1], "A"))) {
                    $result['elements']['ErrorMessage'] = Utils::getMessage('f016');
                } else {
                    $user = DbUser::getByEmail($row[DbUser::EMAIL]);
                    if (!empty($user)) {
                        $result['elements']['ErrorMessage'] = Utils::getMessage('f024');
                    }
                }
            }
        }

        if (empty($row[DbUser::PASS])) {
            $result['elements']['ErrorMessage'] = Utils::getMessage('f001');
        } else {
            if (strlen($row[DbUser::PASS]) < 6) {
                $result['elements']['ErrorMessage'] = Utils::getMessage('f020');
            } else if (strlen($row[DbUser::PASS]) > 32) {
                $result['elements']['ErrorMessage'] = Utils::getMessage('f021');
            } else if ($row[DbUser::PASS] == $row[DbUser::EMAIL]) {
                $result['elements']['ErrorMessage'] = Utils::getMessage('f023');
            } else {
                $row[DbUser::PASS] = Utils::genPass($row[DbUser::PASS]);
            }
        }

        return $result;
    }

    private function send_activation($row)
    {
        $link = 'http://' . __CONFIG_NM_HOST__ . sprintf(\apps\accounts\Activate::URL, $row['user_activation']);
        $message = <<<EOD
<p>To verify your account and complete the signup process please go to the link below. </p>
<p><a href="{$link}">{$link}</a></p>
EOD;
        return Utils::mailTemplate($row['user_email'], 'Account Activation', $message);
    }
}
