<?php

/**
 *  class.EmailBuilder.php
 *
 *  @author Michael van der Werve
 *  @author Brechje Boeklagen
 */

require_once 'autoload.php';

class HtmlEmailBuilder {
    private $str;
    function __construct($html) {
        // get the original directory
        $loc = dirname(dirname(__FILE__)); 

        // get the css (combination of both used stylesheets!)
        $css = file_get_contents($loc . '/css/reset.css') . file_get_contents($loc . '/css/basis.css');

        // make the emogrifier
        $emogrifier = new Pelago\Emogrifier($html, $css);
        
        // merge it for the mail 
        $this->str = $emogrifier->emogrifyBodyContent($html, $css);
    } 

    public function __toString() {
        return (string) $this->str;
    }
}
