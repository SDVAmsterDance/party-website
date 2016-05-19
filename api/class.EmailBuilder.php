<?php

/**
 *  class.EmailBuilder.php
 *
 *  @author Michael van der Werve
 *  @author Brechje Boeklagen
 */

class EmailBuilder {
    private $str;
    function __construct($registration, $web = true) {
        // make the story
        $story = (string) new StoryBuilder($registration, $web);

        // get the css (combination of both used stylesheets!)
        $css = file_get_contents('reset.css') . file_get_contents('basis.css');

        // make the html
        $html = <<<EOD
<html>
<head>
    <meta charset="ISO-8859-1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="wrapper">
<div id="parchment">
<div id="content">
    
    <div id="banner-title">
        <div id="title-presents">AmsterDance presents...</div>
        <div id="title">Your Very Own Royal Ticket</div>
    </div>
    
    <div class="stories clearfix">
    <div class="story"> 
        $story
    </div>	
    
</div>
</div>
</div>

</body>
</html>
EOD;
        // make the emogrifier
        $emogrifier = new \Pelago\Emogrifier($html, $css);
        
        // merge it for the mail 
        $this->str = $web ? $emogrifier->emogrify() : $emogrifier->emogrifyBodyContent($html, $css);
    } 

    public function __toString() {
        return (string) $this->str;
    }
}
