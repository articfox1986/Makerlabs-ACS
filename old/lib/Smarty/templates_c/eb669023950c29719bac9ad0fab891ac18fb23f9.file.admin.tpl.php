<?php /* Smarty version Smarty-3.1.18, created on 2014-08-14 12:24:40
         compiled from "./templates/admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:59381099153dd04ee8c6114-09555089%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eb669023950c29719bac9ad0fab891ac18fb23f9' => 
    array (
      0 => './templates/admin.tpl',
      1 => 1408011836,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '59381099153dd04ee8c6114-09555089',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53dd04ee90daf0_72789249',
  'variables' => 
  array (
    'header' => 0,
    'nav' => 0,
    'users' => 0,
    'user' => 0,
    'footer' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53dd04ee90daf0_72789249')) {function content_53dd04ee90daf0_72789249($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['header']->value;?>

        <!-- Make sure all your bars are the first things in your <body> -->
        <header class="bar bar-nav">
            <h1 class="title">Users</h1>
        </header>
        <?php echo $_smarty_tpl->tpl_vars['nav']->value;?>

        <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
        <div class="content">
            <div class="card">
            <ul class="table-view">
                <?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['user']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value) {
$_smarty_tpl->tpl_vars['user']->_loop = true;
?>
                    <li class="table-view-cell">
                        <a class="navigate-right" href="editUser.php?id=<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
" data-transition="slide-in">
                            <span class="badge"><?php if (!isset($_smarty_tpl->tpl_vars['user']) || !is_array($_smarty_tpl->tpl_vars['user']->value)) $_smarty_tpl->createLocalArrayVariable('user');
if ($_smarty_tpl->tpl_vars['user']->value['enable'] = 1) {?>Verified<?php } else { ?>Unverified<?php }?></span>
                            <?php echo $_smarty_tpl->tpl_vars['user']->value['name'];?>

                        </a>
                    </li>
                <?php } ?>
            </ul>
            </div>
        </div>
<?php echo $_smarty_tpl->tpl_vars['footer']->value;?>
<?php }} ?>
