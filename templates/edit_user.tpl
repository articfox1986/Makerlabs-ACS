{include file="header.tpl"}
<!-- Make sure all your bars are the first things in your <body> -->
<header class="bar bar-nav">
    <a href="admin.php"><button class="btn pull-left">Back</button></a>
    <a href="javascript: submitform()"><button class="btn pull-right" type="submit">Save</button></a>
    <h1 class="title">Edit User</h1>
</header>
{include file="menu.tpl" isAdmin=$isAdmin menuSelected=$menuSelected}
<!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
<div class="content">
    <form class="input-group" name="editForm"  METHOD=POST enctype="multipart/form-data" ACTION="{$url}">
        <div class="input-row">
            <label>Full name</label>
            <input type="text" name="name" value="{$user['name']}">
        </div>
        <div class="input-row">
            <label>Email</label>
            <input type="text" name="email" value="{$user['email']}">
        </div>
        <div class="input-row">
            <label>Password</label>
            <input type="text" name="password" value="{$user['password']}">
        </div>
        <div class="input-row">
            <label>Verified</label>
            <!--<div class="toggle-handle {if $user['enable'] == 1}active{/if}">-->
            <input type="checkbox" name="enable" value="1" {if $user['enable'] == 1}checked="checked"{/if}>
            <!--<div class="toggle-handle"></div>
        </div>-->
        </div>
        <div class="input-row">
            <label>Type</label>
            <select name="accessLevel">
                <option value="1"{if $user['accessLevel'] eq 1} selected=selected{/if}>User</option>
                <option value="2"{if $user['accessLevel'] eq 2} selected=selected{/if}>Admin</option>
                <option value="3"{if $user['accessLevel'] eq 3} selected=selected{/if}>Super User</option>
            </select>
        </div>

        <!--<button type="submit" class="btn btn-positive btn-block">Save</button>-->
    </form>
</div>
{include file="footer.tpl"}