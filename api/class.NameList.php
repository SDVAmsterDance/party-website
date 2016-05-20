<?php

/**
 * class.Namelist.php
 * 
 * @author Michael van der Werve
 * @author Brechje Boeklagen
 */
 
 class NameList {
     
     private $str;
     
     public function __construct($arr) {
        $len = count($arr);
        if ($len == 1) $this->str = (string)$arr[0];
        else if ($len == 2) $this->str = (string) $arr[0] . " and " . (string)$arr[1];
        else {
            for ($i = 0; $i < $len - 1; $i++) $this->str .= (string) $arr[$i] . ", ";
            $this->str .= " and " . (string) $arr[$len - 1];
        }
     }
     
     public function __toString() {
         return htmlentities($this->str, ENT_QUOTES);
     }
 }
