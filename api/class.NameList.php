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
        if ($len == 1) $this->str = $arr[0];
        else if ($len == 2) $this->str = $arr[0] . " and " . $arr[1];
        else {
            for ($i = 0; $i < $len - 1; $i++) $this->str .= $arr[$i] . ", ";
            $this->str .= " and " . $arr[$len - 1];
        }
     }
     
     public function __toString() {
         return $this->str;
     }
 }