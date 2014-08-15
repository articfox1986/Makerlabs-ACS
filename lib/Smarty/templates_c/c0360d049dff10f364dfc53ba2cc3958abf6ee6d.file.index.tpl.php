<?php /* Smarty version Smarty-3.1.18, created on 2014-08-14 10:57:15
         compiled from "./templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:56540105253db6c4588cae2-35738539%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c0360d049dff10f364dfc53ba2cc3958abf6ee6d' => 
    array (
      0 => './templates/index.tpl',
      1 => 1408006626,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '56540105253db6c4588cae2-35738539',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53db6c458c5280_75307352',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53db6c458c5280_75307352')) {function content_53db6c458c5280_75307352($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>MakerLabs Access Control</title>

        <!-- Sets initial viewport load and disables zooming  -->
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

        <!-- Makes your prototype chrome-less once bookmarked to your phone's home screen -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <!-- Include the compiled Ratchet CSS -->
        <link href="http://gate.makerlabs.co.za/lib/css/ratchet.css" rel="stylesheet">

        <!-- font awesome css -->
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <!-- Include the compiled Ratchet JS -->
        <script src="http://gate.makerlabs.co.za/lib/js/ratchet.js"></script>
    </head>
    <body>

        <!-- Make sure all your bars are the first things in your <body> -->
        <header class="bar bar-nav">
            <h1 class="title">MakerLabs Access Control</h1>
        </header>
        <nav class="bar bar-tab">
            <a class="tab-item active" href="http://makerlabs.co.za"  data-ignore="push">
                Powered by Makerlabs.co.za
            </a>
        </nav>
        <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
        <div class="content">
            <div class="card">
                <p class="content-padded">Access control app for Makerlabs front gate. If you would like access. please login via google plus</p>
            </div>
            <p class="content-padded"><a href="login_with_google.php" data-ignore="push">
                    <button class="btn btn-negative btn-block">
                        <i class="fa fa-google-plus" style="width:16px; height:20px"></i>
                        Sign in with Google
                    </button></a>
            </p>
        </div>

    </body>
</html><?php }} ?>
