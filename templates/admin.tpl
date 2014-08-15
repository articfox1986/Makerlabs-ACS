{$header}
        <!-- Make sure all your bars are the first things in your <body> -->
        <header class="bar bar-nav">
            <h1 class="title">Users</h1>
        </header>
        {$nav}
        <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
        <div class="content">
            <div class="card">
            <ul class="table-view">
                {foreach from=$users item=user}
                    <li class="table-view-cell">
                        <a class="navigate-right" href="editUser.php?id={$user['id']}" data-transition="slide-in">
                            <span class="badge">{if $user['enable'] = 1}Verified{else}Unverified{/if}</span>
                            {$user['name']}
                        </a>
                    </li>
                {/foreach}
            </ul>
            </div>
        </div>
{$footer}