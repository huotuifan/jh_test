<?php

namespace smarty;

require_once 'Smarty.class.php';

class SmartyWrapper extends \Smarty {
    public function __construct() {
        parent::__construct();
        $this->setTemplateDir(DIR_TEMPLATES);
        $this->compile_dir = DIR_COMPILE;
    }

    public function display($template, $cache_id = null, $compile_id = null, $parent = null) {
        parent::display($template, $cache_id, $compile_id, $parent);
    }

    public function fetch($template, $cache_id = null, $compile_id = null, $parent = null, $display = false) {
        return parent::fetch($template, $cache_id, $compile_id, $parent, $display);
    }

    public function assign($tpl_var, $value = null, $nocache = false) {
        parent::assign($tpl_var, $value, $nocache);
    }
}
