<?php

/**
 *  class.TemplateRenderer.php
 *
 *  Take care of smarty stuff.
 *
 *  @author Michael van der Werve
 */

require_once 'autoload.php';

class TemplateRenderer extends Smarty {
    public function __construct() {
        parent::__construct();
        $this->setTemplateDir(dirname(dirname(__FILE__)) . '/templates');
        $this->setCompileDir(dirname(dirname(__FILE__)) . '/templates/.compiled');
        $this->setCacheDir(dirname(dirname(__FILE__)) . '/templates/.cached');
        $this->setConfigDir(dirname(dirname(__FILE__)) . '/templates/.configs');
    }

    function render($template) {
        $this->display($template . '.tpl');
    }

    function str($template) {
        return $this->fetch($template . '.tpl');
    }
}