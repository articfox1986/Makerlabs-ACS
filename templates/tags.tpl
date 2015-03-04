{include file="header.tpl"}
        <!-- Make sure all your bars are the first things in your <body> -->
        <header class="bar bar-nav">
            <h1 class="title">Tags</h1>
        </header>
        {include file="menu.tpl" isAdmin=$isAdmin menuSelected=$menuSelected}
        <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
        <div class="content">
            <div class="card">
            <ul class="table-view">
                {foreach from=$tags item=tag}
                    <li class="table-view-cell">
                        <a class="navigate-right" href="editTag.php?id={$tag['id']}" data-transition="slide-in">
                            <span class="badge">{$tag['tag']}</span>
                            {$tag['name']}
                        </a>
                    </li>
                {/foreach}
            </ul>
            </div>
        </div>
{include file="footer.tpl"}