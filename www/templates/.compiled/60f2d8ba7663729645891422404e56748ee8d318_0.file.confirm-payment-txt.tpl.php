<?php
/* Smarty version 3.1.31, created on 2016-12-28 14:51:53
  from "C:\Users\Michael\Downloads\Galacie-2016-2017-Website\Galacie 2016-2017 Website\www\templates\confirm-payment-txt.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5863c379844cd2_57344594',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '60f2d8ba7663729645891422404e56748ee8d318' => 
    array (
      0 => 'C:\\Users\\Michael\\Downloads\\Galacie-2016-2017-Website\\Galacie 2016-2017 Website\\www\\templates\\confirm-payment-txt.tpl',
      1 => 1482929405,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5863c379844cd2_57344594 (Smarty_Internal_Template $_smarty_tpl) {
?>
English follows Dutch
--------------------------------------------------------------------------------

Geachte <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['registration']->value->buyer()->name, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
,

Je betaling van € <?php echo $_smarty_tpl->tpl_vars['registration']->value->sprice();?>
 is in goede orde ontvangen en je reservering staat hierbij vast. 

We wensen je veel plezier tijdens het Arabian Nights Gala!
        
Dansende groeten,
Andriy, Helena, Marjolein en Tom
GalaCie Commissie 2016 - 2017
SDV AmsterDance

--------------------------------------------------------------------------------

Dear <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['registration']->value->buyer()->name, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
, 

Your payment of € <?php echo $_smarty_tpl->tpl_vars['registration']->value->sprice();?>
 has been fully received and your reservation has been fully confirmed.

We wish you a magical evening at the Arabian Nights Gala!

Kind regards,
Andriy, Helena, Marjolein and Tom
GalaCie Commissie 2016 - 2017
SDV AmsterDance

--------------------------------------------------------------------------------
<?php }
}
