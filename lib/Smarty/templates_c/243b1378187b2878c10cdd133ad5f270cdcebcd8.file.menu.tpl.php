<?php /* Smarty version Smarty-3.1.18, created on 2014-08-14 12:33:19
         compiled from "./templates/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:663768253ec8afcaccd24-61830665%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '243b1378187b2878c10cdd133ad5f270cdcebcd8' => 
    array (
      0 => './templates/menu.tpl',
      1 => 1408012391,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '663768253ec8afcaccd24-61830665',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53ec8afcb0e227_87538313',
  'variables' => 
  array (
    'menuSelected' => 0,
    'isAdmin' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ec8afcb0e227_87538313')) {function content_53ec8afcb0e227_87538313($_smarty_tpl) {?><nav class="bar bar-tab">
    <a class="tab-item <?php if ($_smarty_tpl->tpl_vars['menuSelected']->value=='home') {?>active<?php }?>" href="test.php">
        <span class="icon icon-home"></span>
        <span class="tab-label">Home</span>
    </a>
    <?php if ($_smarty_tpl->tpl_vars['isAdmin']->value==1) {?>
        <a class="tab-item <?php if ($_smarty_tpl->tpl_vars['menuSelected']->value=='users') {?>active<?php }?>" href="admin.php" data-transition="slide-in">
            <span class="icon icon-gear"></span>
            <span class="tab-label">Users</span>
        </a>
        <a class="tab-item <?php if ($_smarty_tpl->tpl_vars['menuSelected']->value=='logs') {?>active<?php }?>" href="log.php"  data-transition="slide-in">
            <span class="icon icon-search"></span>
            <span class="tab-label">Logs</span>
        </a>
    <?php }?>
    <a class="tab-item" href="index.php?action=logout">
        <span class="icon icon-person"></span>
        <span class="tab-label">Logout</span>
    </a>

</nav><?php }} ?>
