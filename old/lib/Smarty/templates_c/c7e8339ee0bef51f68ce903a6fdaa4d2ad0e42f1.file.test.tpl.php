<?php /* Smarty version Smarty-3.1.18, created on 2014-08-01 10:42:54
         compiled from "templates/test.tpl" */ ?>
<?php /*%%SmartyHeaderCode:207955957653db530e444846-24470711%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c7e8339ee0bef51f68ce903a6fdaa4d2ad0e42f1' => 
    array (
      0 => 'templates/test.tpl',
      1 => 1406882470,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '207955957653db530e444846-24470711',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53db530e484645_16434620',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53db530e484645_16434620')) {function content_53db530e484645_16434620($_smarty_tpl) {?><html>
    <head>
        <title>Makerlabs Access Control</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    </head>
    <body bgcolor="#FFFFFF">
        <h1>MakerLabs Access Control</h1>

        <br><br>
        <FORM METHOD=POST enctype="multipart/form-data" ACTION="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
">
              <!--Access Token: <input type="text" name="my_access_token" value="<<?php ?>?php //echo($my_access_token);   ?<?php ?>>"><br>-->
              <!--Device ID: <input type="text" name="my_device" value="<<?php ?>?php //echo($my_device);   ?<?php ?>>"><br>-->
              <label for="level_high">HIGH</label><input type="radio" id="level_high" name="level" value="HIGH" checked="checked"/>
            <label for="level_low">LOW</label><input type="radio" id="level_low" name="level" value="LOW"/>
            <input type="Submit" name="Submit" value="Submit">
        </form>
    </body>
</html><?php }} ?>
