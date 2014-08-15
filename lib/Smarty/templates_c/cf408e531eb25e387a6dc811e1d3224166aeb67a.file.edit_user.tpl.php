<?php /* Smarty version Smarty-3.1.18, created on 2014-08-14 22:24:51
         compiled from "./templates/edit_user.tpl" */ ?>
<?php /*%%SmartyHeaderCode:56967481453dd203ad38df8-70233914%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cf408e531eb25e387a6dc811e1d3224166aeb67a' => 
    array (
      0 => './templates/edit_user.tpl',
      1 => 1408047425,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '56967481453dd203ad38df8-70233914',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53dd203ada12b1_20324699',
  'variables' => 
  array (
    'header' => 0,
    'nav' => 0,
    'url' => 0,
    'user' => 0,
    'footer' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53dd203ada12b1_20324699')) {function content_53dd203ada12b1_20324699($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['header']->value;?>

        <!-- Make sure all your bars are the first things in your <body> -->
        <header class="bar bar-nav">
            <a href="admin.php"><button class="btn pull-left">
                    Back
                </button></a>
            <a href="javascript: submitform()"><button class="btn pull-right" type="submit">
                    Save
                </button></a>
            <h1 class="title">Edit User</h1>
        </header>
        <?php echo $_smarty_tpl->tpl_vars['nav']->value;?>

        <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
        <div class="content">
            <form class="input-group" name="editForm"  METHOD=POST enctype="multipart/form-data" ACTION="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
">
                <div class="input-row">
                    <label>Full name</label>
                    <input type="text" name="name" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['name'];?>
">
                </div>
                <div class="input-row">
                    <label>Email</label>
                    <input type="text" name="email" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['email'];?>
">
                </div>
                <div class="input-row">
                    <label>Password</label>
                    <input type="text" name="password" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['password'];?>
">
                </div>
                <div class="input-row">
                    <label>Verified</label>
                    <!--<div class="toggle-handle <?php if ($_smarty_tpl->tpl_vars['user']->value['enable']==1) {?>active<?php }?>">-->
                    <input type="checkbox" name="enable" value="1" <?php if ($_smarty_tpl->tpl_vars['user']->value['enable']==1) {?>checked="checked"<?php }?>>
                    <!--<div class="toggle-handle"></div>
                </div>-->
                </div>
                <div class="input-row">
                    <label>Type</label>
                    <select name="accessLevel">
                        <option value="1"<?php if ($_smarty_tpl->tpl_vars['user']->value['accessLevel']==1) {?> selected=selected<?php }?>>User</option>
                        <option value="2"<?php if ($_smarty_tpl->tpl_vars['user']->value['accessLevel']==2) {?> selected=selected<?php }?>>Admin</option>
                        <option value="3"<?php if ($_smarty_tpl->tpl_vars['user']->value['accessLevel']==3) {?> selected=selected<?php }?>>Super User</option>
                    </select>
                </div>

                <!--<button type="submit" class="btn btn-positive btn-block">Save</button>-->
            </form>
            <script type="text/javascript">
                function submitform()
                {
                    document.editForm.submit();
                }
            </script>     
        </div>
                <?php echo $_smarty_tpl->tpl_vars['footer']->value;?>
<?php }} ?>
