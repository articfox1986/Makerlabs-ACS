<?php /* Smarty version Smarty-3.1.18, created on 2014-08-14 12:24:38
         compiled from "./templates/test.tpl" */ ?>
<?php /*%%SmartyHeaderCode:144023736853db5d82265d14-46735896%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2319eb374ebfda6635cffe78ca7a13eed09695fd' => 
    array (
      0 => './templates/test.tpl',
      1 => 1408011867,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '144023736853db5d82265d14-46735896',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53db5d822bdc26_31761410',
  'variables' => 
  array (
    'header' => 0,
    'nav' => 0,
    'url' => 0,
    'footer' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53db5d822bdc26_31761410')) {function content_53db5d822bdc26_31761410($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['header']->value;?>


        <!-- Make sure all your bars are the first things in your <body> -->
        <header class="bar bar-nav">
            <h1 class="title">MakerLabs Access Control</h1>
        </header>
        <?php echo $_smarty_tpl->tpl_vars['nav']->value;?>

        <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
        <div class="content">
            <FORM METHOD=POST enctype="multipart/form-data" ACTION="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
">
                <!--Access Token: <input type="text" name="my_access_token" value="<<?php ?>?php //echo($my_access_token);   ?<?php ?>>"><br>-->
                <!--Device ID: <input type="text" name="my_device" value="<<?php ?>?php //echo($my_device);   ?<?php ?>>"><br>-->
                <!--<label for="level_high">HIGH</label><input type="radio" id="level_high" name="level" value="HIGH" checked="checked"/>-->
                <!--<label for="level_low">LOW</label><input type="radio" id="level_low" name="level" value="LOW"/>-->
                <!--<input type="Submit" name="Submit" value="Open" style="width:60px;height:30px;">-->
                <button class="btn btn-positive btn-block" type="submit">Open Gate</button>
            </form>
                <a href="#myModalexample"><button class="btn btn-negative btn-block" type="submit">Open Model</button></a>
<div id="myModalexample" class="modal">
  <header class="bar bar-nav">
    <a class="icon icon-close pull-right" href="#myModalexample"></a>
    <h1 class="title">Modal</h1>
  </header>

  <div class="content">
    <p class="content-padded">The contents of my modal go here. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut.</p>
  </div>
</div>
        </div>
<?php echo $_smarty_tpl->tpl_vars['footer']->value;?>
<?php }} ?>
