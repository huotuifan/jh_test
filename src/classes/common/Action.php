<?php

namespace common;

interface Action
{
    const OK = 'OK';
    const ERROR = 'ERROR';
    const STATUS = 'status';

    function init();

    function execute();

    function getName();

}
