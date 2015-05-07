<?php

namespace actions\common;

use \utils\Utils;
use \db\DbUser;

class ActionForgotSend extends \common\AjaxAction
{

    const NAME = 'common.forgot.send';
    private $user;

    function getName()
    {
        return self::NAME;
    }

    function execute()
    {
        error_log("inside actionforgotsend", 3, "/var/tmp/my-errors.log");
        $row = $this->parseModel();
        $errors = $this->getFieldValues($row);

        if (!empty($errors)) {
            Utils::json($errors);
        } else {
            DbUser::updateById($this->user[DbUser::ID], array(DbUser::FORGOT => $row[DbUser::FORGOT]));
            $row['user_id'] = $this->user[DbUser::ID];
            $this->send_forgot($row);

            Utils::json(array(
                self::STATUS => self::OK,
                'message' => Utils::getMessage('u004')
            ));
        }
    }

    private function parseModel()
    {
        return array(
            DbUser::EMAIL => trim($this->model['email']),
            DbUser::FORGOT => Utils::genUuid(16),
        );
    }

    private function getFieldValues(&$row)
    {
        $result = array();

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
                    $this->user = DbUser::getByEmail($row[DbUser::EMAIL]);
                    if (empty($this->user)) {
                        $result['elements']['ErrorMessage'] = Utils::getMessage('f026');
                    }

                }
            }
        }

        return $result;
    }

    private function send_forgot($row)
    {
        $link = 'http://' . __CONFIG_NM_HOST__ . sprintf(\apps\accounts\Forgot::URL, $row['user_forgot'], $row['user_id']);
        $message = <<<EOD
<p>To change your password please go to the link below. </p>
<p><a href="{$link}">{$link}</a></p>
EOD;
        return Utils::mailTemplate($row['user_email'], 'Forgot Password', $message);
    }
}
