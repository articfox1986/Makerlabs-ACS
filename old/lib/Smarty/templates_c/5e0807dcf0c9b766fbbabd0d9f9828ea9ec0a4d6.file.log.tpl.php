<?php /* Smarty version Smarty-3.1.18, created on 2014-08-14 12:16:39
         compiled from "./templates/log.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12645687153e7d1f08db706-97226416%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5e0807dcf0c9b766fbbabd0d9f9828ea9ec0a4d6' => 
    array (
      0 => './templates/log.tpl',
      1 => 1408011230,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12645687153e7d1f08db706-97226416',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53e7d1f0d0bcb7_43128758',
  'variables' => 
  array (
    'header' => 0,
    'nav' => 0,
    'logs' => 0,
    'log' => 0,
    'footer' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53e7d1f0d0bcb7_43128758')) {function content_53e7d1f0d0bcb7_43128758($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['header']->value;?>

        <!-- Make sure all your bars are the first things in your <body> -->
        <header class="bar bar-nav">
            <h1 class="title">Access Log</h1>
        </header>
        <?php echo $_smarty_tpl->tpl_vars['nav']->value;?>

        <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
        <div class="content">
            <div class="card">
                <ul class="table-view">
                    <?php  $_smarty_tpl->tpl_vars['log'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['log']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['logs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['log']->key => $_smarty_tpl->tpl_vars['log']->value) {
$_smarty_tpl->tpl_vars['log']->_loop = true;
?>
                        <li class="table-view-cell media">
                            <div class="media-body">
                                <?php echo $_smarty_tpl->tpl_vars['log']->value['name'];?>

                                <p><?php echo $_smarty_tpl->tpl_vars['log']->value['description'];?>
<br /><?php echo $_smarty_tpl->tpl_vars['log']->value['date'];?>
</p>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
<?php echo $_smarty_tpl->tpl_vars['footer']->value;?>
<?php }} ?>
