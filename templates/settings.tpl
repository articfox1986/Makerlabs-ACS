{include file="header.tpl"}
<!-- Make sure all your bars are the first things in your <body> -->
<header class="bar bar-nav">
    <a href="admin.php"><button class="btn pull-left">Back</button></a>
    <a href="javascript: submitform()"><button class="btn pull-right" type="submit">Save</button></a>
    <h1 class="title">Settings</h1>
</header>
{include file="menu.tpl" isAdmin=$isAdmin menuSelected=$menuSelected}
<!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
<div class="content">
    <form class="input-group" name="editForm"  METHOD=POST enctype="multipart/form-data" ACTION="{$url}">
        {foreach from=$settings item=setting}
                <div class="input-row">
                    <label>{$setting['name']}</label>
                    <input type="text" name="name" value="{$setting['value']}">
                </div>
                
            {/foreach}

        <!--<button type="submit" class="btn btn-positive btn-block">Save</button>-->
    </form>
</div>
{include file="footer.tpl"}