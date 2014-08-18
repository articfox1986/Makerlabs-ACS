{include file="header.tpl"}
        <!-- Make sure all your bars are the first things in your <body> -->
        <header class="bar bar-nav">
            <h1 class="title">Access Log</h1>
        </header>
        {include file="menu.tpl" isAdmin=$isAdmin menuSelected=$menuSelected}
        <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
        <div class="content">
            <div class="card">
                <ul class="table-view">
                    {foreach from=$logs item=log}
                        <li class="table-view-cell media">
                            <div class="media-body">
                                {$log['name']}
                                <p>{$log['description']}<br />{$log['date']}</p>
                            </div>
                        </li>
                    {/foreach}
                </ul>
            </div>
        </div>
{include file="footer.tpl"}