<?php

/**
 *  view.php
 *  
 *  This allows you to view a template with all the usual variables.
 *  @author Michael van der Werve
 *  @copyright 2016
 */

// require the loader
require_once '../api/autoload.php';

// make the renderer
$tpl = new TemplateRenderer;

// pass a registration
$registration = Registration::get($_GET['hash']);

// it may be text after all
$text = isset($_GET['text']);

// the file
$file = basename($_GET['file']);

// pass the filename to the display
$tpl->assign('registration', $registration);

// view the file
$output = $tpl->fetch($file . '.tpl');

// we regard it as pure text if that is given
if ($text) echo nl2br(htmlentities($output));
else echo $output; 