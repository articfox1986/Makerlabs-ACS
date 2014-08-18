{include file="header.tpl"}
        <!-- Make sure all your bars are the first things in your <body> -->
        <header class="bar bar-nav">
            <h1 class="title">Admin Area</h1>
        </header>
        {include file="menu.tpl" isAdmin=$isAdmin menuSelected=$menuSelected}
        <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
        <div class="content">
            <div class="card">
            <ul class="table-view">
                    <li class="table-view-cell">
                        <a class="navigate-right" href="settings.php" data-transition="slide-in">Settings</a>
                    </li>
                    <li class="table-view-cell">
                        <a class="navigate-right" href="logs.php" data-transition="slide-in">Logs</a>
                    </li>
            </ul>
            </div>
        </div>
{include file="footer.tpl"}