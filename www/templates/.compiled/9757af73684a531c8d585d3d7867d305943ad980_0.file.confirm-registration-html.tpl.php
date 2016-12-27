<?php
/* Smarty version 3.1.31, created on 2016-12-27 19:23:29
  from "C:\Users\Michael\Downloads\Galacie-2016-2017-Website\Galacie 2016-2017 Website\www\templates\confirm-registration-html.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5862b1a133e2c6_53491866',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9757af73684a531c8d585d3d7867d305943ad980' => 
    array (
      0 => 'C:\\Users\\Michael\\Downloads\\Galacie-2016-2017-Website\\Galacie 2016-2017 Website\\www\\templates\\confirm-registration-html.tpl',
      1 => 1482862426,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5862b1a133e2c6_53491866 (Smarty_Internal_Template $_smarty_tpl) {
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="../css/basis.css"/>
    <meta charset="ISO-8859-1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="wrapper">
<div id="parchment">
<div id="content">
    <br><br>
    <div id="banner-title">
        <div id="title-presents"> SDV AmsterDance presents...</div>
        <div id="title">Arabian Nights Ballroom Gala</div>
        <div id="date">10th of February, 2017</div>
        <div id="time">Rhone Events: Humberweg 5, Amsterdam. 20:00 - 0:30</div>
    </div>
    
    <div class="stories clearfix">
    <div class="story"> 
        English follows Dutch
        
        <br><hr><br>

        <div class="story-internal">
            <b><div class="calligraphy love">G</div>eachte <?php echo $_smarty_tpl->tpl_vars['registration']->value->buyer()->name;?>
</b>,
        </div><br><br>
        
        <div class="story-internal">
            We zijn blij te horen dat je interesse hebt in ons evenement. Met deze mail bevestigen wij je reservering. 
        </div><br><br>   

        <div class="story-internal">
            <div class="calligraphy love">J</div>e reservering bevat een kaartje <?php if ($_smarty_tpl->tpl_vars['registration']->value->buyer()->member) {?>met<?php } else { ?>zonder<?php }?> lidmaatschap<?php if ($_smarty_tpl->tpl_vars['registration']->value->buyer()->vip) {?> en met behandeling als een Sultan<?php }?>.<?php if ($_smarty_tpl->tpl_vars['registration']->value->nguests() > 0) {?> Daarnaast bevat de reservering kaartjes voor <?php echo $_smarty_tpl->tpl_vars['registration']->value->sguests();
if ($_smarty_tpl->tpl_vars['registration']->value->nvips() > 0) {?> waarbij <?php echo $_smarty_tpl->tpl_vars['registration']->value->svips();?>
 behandeld <?php if ($_smarty_tpl->tpl_vars['registration']->value->nvips() == 1) {?>zal<?php } else { ?>zullen<?php }?> worden als een Sultan<?php }
}?>.
        </div><br><br>

        <div class="story-internal">
            <div class="calligraphy love">O</div>m je reservering definitief te maken, maak <p class="love">&euro; <?php echo $_smarty_tpl->tpl_vars['registration']->value->sprice();?>
</p> over naar <p class="love">NL72 ABNA 0455 2572 21</p> ter name van SDV AmsterDance, onder vermelding van "Gala 2017 - <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['registration']->value->buyer()->name, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
".
		</div><br><br>

        <div class="story-internal">
            Mocht je het geld niet hebben overgemaakt voor 9 februari 23:59, dan gaat je reservering verloren. Natuurlijk kan je dan nog wel een kaartje kopen aan de deur voor &euro; 17,50 (indien er nog kaarten beschikbaar zijn).
        </div><br><br>

        <div class="story-internal">
            <div class="calligraphy love">D</div>ansende groeten,<br>
            Andriy, Helena, Marjolein, Philine en Tom<br>
            GalaCie Commissie 2016 - 2017<br>
            SDV AmsterDance<br>
        </div>
        
        <br><hr><br>

        <div class="story-internal">
            <b><div class="calligraphy love">D</div>ear <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['registration']->value->buyer()->name, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</b>,
        </div><br><br>
    
        <div class="story-internal">
            We are happy to see that you are interested in our event! With this email we confirm your reservation for the Arabian Nights Gala.
        </div><br><br>
        
        <div class="story-internal">
            <div class="calligraphy love">Y</div>our reservation contains a ticket <?php if ($_smarty_tpl->tpl_vars['registration']->value->buyer()->member) {?>with<?php } else { ?>without<?php }?> membership<?php if ($_smarty_tpl->tpl_vars['registration']->value->buyer()->vip) {?> and with Sultan treatment<?php }?>.<?php if ($_smarty_tpl->tpl_vars['registration']->value->nguests() > 0) {?> Additionally, your reservation contains tickets for <?php echo $_smarty_tpl->tpl_vars['registration']->value->sguests();
if ($_smarty_tpl->tpl_vars['registration']->value->nvips() > 0) {?> of which <?php echo $_smarty_tpl->tpl_vars['registration']->value->svips();?>
 shall be treated <?php if ($_smarty_tpl->tpl_vars['registration']->value->nvips() == 1) {?>as a Sultan<?php } else { ?>as Sultans<?php }
}
}?>.
        </div><br><br>

        <div class="story-internal">
            <div class="calligraphy love">T</div>o complete your reservation, please transfer <p class="love">&euro; <?php echo $_smarty_tpl->tpl_vars['registration']->value->sprice();?>
</p> to account number <p class="love">NL72 ABNA 0455 2572 21</p> in the name of SDV AmsterDance. Please state "Gala 2017 - <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['registration']->value->buyer()->name, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" in the description. Thank you very much!
		</div><br><br>

        <div class="story-internal">
            Please be aware that if you do not transfer the amount before the 9th of february at 23:59, your reservation will be cancelled. After the cancellation, you can still buy a ticket at the door (unless the event is sold out). A ticket at the door will cost &euro; 17,50.
        </div><br><br>

        <div class="story-internal">
            <div class="calligraphy love">K</div>ind regards,<br<
            Andriy, Helena, Marjolein, Philine and Tom<br>
            GalaCie Commissie 2016 - 2017<br>
            SDV AmsterDance<br>
        </div>

        <br><hr><br>
        <center><a class="love" href="https://localhost/email.php?registration=<?php echo $_smarty_tpl->tpl_vars['registration']->value->hash();?>
">Webversion</a></center><br><br>
    </div>	
</div>
</div>
</div>

</body>
</html><?php }
}
