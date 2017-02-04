<?php
/* Smarty version 3.1.31, created on 2016-12-28 14:38:04
  from "C:\Users\Michael\Downloads\Galacie-2016-2017-Website\Galacie 2016-2017 Website\www\templates\confirm-registration-txt.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5863c03ce42e26_28414617',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '452581344d28d94734ac2436b72151a3d8a76416' => 
    array (
      0 => 'C:\\Users\\Michael\\Downloads\\Galacie-2016-2017-Website\\Galacie 2016-2017 Website\\www\\templates\\confirm-registration-txt.tpl',
      1 => 1482929465,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5863c03ce42e26_28414617 (Smarty_Internal_Template $_smarty_tpl) {
?>
English follows Dutch

--------------------------------------------------------------------------------
Geachte <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['registration']->value->buyer()->name, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
,

We zijn blij te horen dat je interesse hebt in ons evenement. Met deze mail bevestigen wij je reservering.

Je reservering bevat een kaartje <?php if ($_smarty_tpl->tpl_vars['registration']->value->buyer()->member) {?>met<?php } else { ?>zonder<?php }?> lidmaatschap<?php if ($_smarty_tpl->tpl_vars['registration']->value->buyer()->vip) {?> en met behandeling als een Sultan<?php }?>.<?php if ($_smarty_tpl->tpl_vars['registration']->value->nguests() > 0) {?> Daarnaast bevat de reservering kaartjes voor <?php echo $_smarty_tpl->tpl_vars['registration']->value->sguests();
if ($_smarty_tpl->tpl_vars['registration']->value->nvips() > 0) {?> waarbij <?php echo $_smarty_tpl->tpl_vars['registration']->value->svips();?>
 behandeld <?php if ($_smarty_tpl->tpl_vars['registration']->value->nvips() == 1) {?>zal<?php } else { ?>zullen<?php }?> worden als een Sultan<?php }
}?>.

De reservering kan definitief gemaakt worden door € <?php echo $_smarty_tpl->tpl_vars['registration']->value->sprice();?>
 over te maken naar NL72 ABNA 0455257221 ten name van SDV AmsterDance, onder vermelding van "Gala 2017 - <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['registration']->value->buyer()->name, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
". 

Mocht je het geld niet hebben overgemaakt voor donderdag 9 februari 23:59, dan gaat je reservering verloren. Natuurlijk kan je dan nog wel een kaartje kopen aan de deur voor € 17,50 (indien er nog kaarten beschikbaar zijn). 
        
Dansende groeten,
Andriy, Helena, Marjolein en Tom
GalaCie Commissie 2016 - 2017
SDV AmsterDance

--------------------------------------------------------------------------------

Dear <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['registration']->value->buyer()->name, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
, 

We are happy to see that you are interested in our event! With this email we confirm your ticket reservation for the Arabian Nights Gala. To complete your reservation, please transfer € <?php echo $_smarty_tpl->tpl_vars['registration']->value->sprice();?>
 to NL72 ABNA 0455 2572 21 in the name of SDV AmsterDance with "Gala 2017 - <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['registration']->value->buyer()->name, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" as the description.

Your reservation contains a ticket <?php if ($_smarty_tpl->tpl_vars['registration']->value->buyer()->member) {?>with<?php } else { ?>without<?php }?> membership<?php if ($_smarty_tpl->tpl_vars['registration']->value->buyer()->vip) {?> and with Sultan treatment<?php }?>.<?php if ($_smarty_tpl->tpl_vars['registration']->value->nguests() > 0) {?> Additionally, your reservation contains tickets for <?php echo $_smarty_tpl->tpl_vars['registration']->value->sguests();
if ($_smarty_tpl->tpl_vars['registration']->value->nvips() > 0) {?> of which <?php echo $_smarty_tpl->tpl_vars['registration']->value->svips();?>
 shall be treated <?php if ($_smarty_tpl->tpl_vars['registration']->value->nvips() == 1) {?>as a Sultan<?php } else { ?>as Sultans<?php }
}
}?>.

Please be aware that if you do not transfer the amount before thursday 9th of february 23:59 your reservation will be cancelled. After the cancellation you can still buy a ticket at the door (unless the event is sold out). A ticket at the door will cost € 17,50.

Kind regards,
Andriy, Helena, Marjolein and Tom
GalaCie Commissie 2016 - 2017
SDV AmsterDance

--------------------------------------------------------------------------------
<?php }
}
