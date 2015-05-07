<?php

namespace common;

class DbModel
{
    protected static function getDB()
    {
        return \utils\DbWorker::getConnection();
    }
}
