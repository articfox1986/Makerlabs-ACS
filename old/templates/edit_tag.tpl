{include file="header.tpl"}
<!-- Make sure all your bars are the first things in your <body> -->
<header class="bar bar-nav">
    <a href="admin.php"><button class="btn pull-left">Back</button></a>
    <a href="javascript: submitform()"><button class="btn pull-right" type="submit">Save</button></a>
    <h1 class="title">Edit Tag</h1>
</header>
{include file="menu.tpl" isAdmin=$isAdmin menuSelected=$menuSelected}
<!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
<div class="content">
    <form class="input-group" name="editForm"  METHOD=POST enctype="multipart/form-data" ACTION="{$url}">
        <div class="input-row">
            <label>Name</label>
            <input type="text" name="name" value="{$tag['name']}">
        </div>
        <div class="input-row">
            <label>ID</label>
            <input type="text" name="email" value="{$tag['tag']}">
        </div>
        <div class="input-row">
            <label>User</label>
            <select name="accessLevel">
                <option value="0"{if $tag['user_id'] eq 0} selected=selected{/if}>None</option>
            </select>
        </div>

        <!--<button type="submit" class="btn btn-positive btn-block">Save</button>-->
    </form>
</div>
{include file="footer.tpl"}