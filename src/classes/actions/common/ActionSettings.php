<?php

namespace actions\common;

use \utils\Utils;
use \db\DbUser;

class ActionSettings extends \common\AjaxAction
{

    const NAME = 'common.settings';

    function getName()
    {
        return self::NAME;
    }

    function execute()
    {
        $row = $this->parseModel();
        $errors = $this->getFieldValues($row);

        if (!empty($errors)) {
            Utils::json($errors);
        } else {
            if (empty($row[DbUser::ID])) {
                Utils::json(array(
                    'message' => Utils::getMessage('s001')
                ));
            } else {
                $id = $row[DbUser::ID];
                unset($row[DbUser::ID]);
                DbUser::updateById($id, $row);
                Utils::json(array(
                    self::STATUS => self::OK
                ));
            }
        }
    }

    private function parseModel()
    {
        return array(
            DbUser::ID => trim($this->model['id']),
            DbUser::NAME => trim($this->model['name']),
            DbUser::EMAIL => trim($this->model['email']),
            DbUser::PASS => trim($this->model['password']),
            DbUser::ABOUT => trim($this->model['about']),
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

        $user = DbUser::getByEmail($row[DbUser::EMAIL]);
        if (!empty($user) && $user[DbUser::ID] != $row[DbUser::ID]) {
            $result['elements']['ErrorMessage'] = Utils::getMessage('f024');
        } else {
/*            if (empty($row[DbUser::EMAIL])) {
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
                    }
                }
            }*/
        }

        if (!empty($row[DbUser::PASS])) {
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
}
