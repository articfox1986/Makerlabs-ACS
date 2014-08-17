<nav class="bar bar-tab">
    <a class="tab-item {if $menuSelected == 'home'}active{/if}" href="index.php" data-transition="slide-in">
        <span class="icon icon-home"></span>
        <span class="tab-label">Home</span>
    </a>
    {if $isAdmin == 1}
        <a class="tab-item {if $menuSelected == 'users'}active{/if}" href="users.php" data-transition="slide-in">
            <span class="icon icon-gear"></span>
            <span class="tab-label">Users</span>
        </a>
        <a class="tab-item {if $menuSelected == 'logs'}active{/if}" href="logs.php"  data-transition="slide-in">
            <span class="icon icon-search"></span>
            <span class="tab-label">Logs</span>
        </a>
    {/if}
    <a class="tab-item" href="login.php?action=logout">
        <span class="icon icon-person"></span>
        <span class="tab-label">Logout</span>
    </a>

</nav>