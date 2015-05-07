<?php

namespace actions\common;

use \utils\Utils;
use \db\DbUser;

class ActionForgotChange extends \common\AjaxAction
{

    const NAME = 'common.forgot.change';
    private $user;

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

            DbUser::updateById($this->user[DbUser::ID], array(DbUser::FORGOT => '', DbUser::PASS => $row[DbUser::PASS]));

            Utils::json(array(
                self::STATUS => self::OK,
                'message' => Utils::getMessage('u005')
            ));
        }
    }

    private function parseModel()
    {
        return array(
            DbUser::PASS => trim($this->model['password']),
            DbUser::ID => trim($this->model['id']),
            DbUser::FORGOT => trim($this->model['forgot_code']),
        );
    }

    private function getFieldValues(&$row)
    {
        $result = array();

        if (strlen($row[DbUser::PASS]) < 6) {
            $result['elements']['ErrorMessage'] = Utils::getMessage('f020');
        } else if (strlen($row[DbUser::PASS]) > 32) {
            $result['elements']['ErrorMessage'] = Utils::getMessage('f021');
        } else {
            $row[DbUser::PASS] = Utils::genPass($row[DbUser::PASS]);
        }

        if (empty($row[DbUser::FORGOT]) || empty($row[DbUser::ID])) {
            $result['elements']['ErrorMessage'] = Utils::getMessage('s001');
        }

        $this->user = DbUser::getByForgotCodeAndId($row[DbUser::FORGOT], $row[DbUser::ID]);

        if (empty($this->user)) {
            $result['elements']['ErrorMessage'] = Utils::getMessage('f027');
        }

        return $result;
    }
}
