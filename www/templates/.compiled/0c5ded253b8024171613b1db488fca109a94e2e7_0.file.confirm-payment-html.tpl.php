<?php
/* Smarty version 3.1.31, created on 2016-12-27 20:02:51
  from "C:\Users\Michael\Downloads\Galacie-2016-2017-Website\Galacie 2016-2017 Website\www\templates\confirm-payment-html.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5862badbb78718_15939587',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0c5ded253b8024171613b1db488fca109a94e2e7' => 
    array (
      0 => 'C:\\Users\\Michael\\Downloads\\Galacie-2016-2017-Website\\Galacie 2016-2017 Website\\www\\templates\\confirm-payment-html.tpl',
      1 => 1482865364,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5862badbb78718_15939587 (Smarty_Internal_Template $_smarty_tpl) {
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
            <b><div class="calligraphy love">G</div>eachte <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['registration']->value->buyer()->name, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</b>,
        </div><br><br>

        <div class="story-internal">
            Je betaling van <div class="love">&euro; <?php echo $_smarty_tpl->tpl_vars['registration']->value->sprice();?>
</div> is in goede orde ontvangen en je reservering staat hierbij vast. 
        </div><br><br>

        <div class="story-internal">
            We wensen je veel plezier tijdens het Arabian Nights Gala!
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
            Your payment of <div class="love">&euro; <?php echo $_smarty_tpl->tpl_vars['registration']->value->sprice();?>
</div> has been fully received and your reservation has been fully confirmed.
        </div><br><br>
        
        <div class="story-internal">
            We wish you a magical evening at the Arabian Nights Gala!
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
