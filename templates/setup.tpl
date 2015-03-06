<h2>Tokens</h2>
<table><tr><th>Token</th><th>Expiry Date</th><th>Client</th></tr>
{foreach from=$tokens item=token}
    <tr><td>{$token->token}</td><td>{$token->expires_at}</td><td>{$token->client}</td></tr>
{/foreach}
</table>

<br />

<h2>Sparks</h2>
    <table><tr><th>ID</th><th>Name</th><th>Last Heard</th><th>Connected</th></tr>
    {foreach from=$cores item=device}
<tr><td>{$device->id}</td><td>{$device->name}</td><td>{$device->last_heard}</td><td>{$device->connected}</td></tr>

    {/foreach}
</table>
<br />

<h2>Variables and Functions</h2>
{foreach from=$nodes item=node}
    {if $node != FALSE}
        <h3>{$node->id}</h3>
        <h2>Functions</h2>

        <ul>
        {foreach from=$node->functions item=func}
            <li>{$func}</li>

        {/foreach}
        </ul>

        <h2>Variables</h2>
        <ul>
        {foreach from=$node->variables item=var}
            <li>{$var}</li>   
        {/foreach}
        </ul>
    {else}
    Core not online!<br />
    {/if}

{/foreach}

<h2>Webhooks</h2>
<table><tr><th>ID</th><th>Url</th><th>deviceID</th><th>event</th><th>created_at</th></tr>
    {foreach from=$webhooks item=webhook}
        <tr><td>{$webhook->id}</td><td>{$webhook->url}</td><td>{$webhook->deviceID}</td><td>{$webhook->event}</td><td>{$webhook->created_at}</td></tr>
    {/foreach}
</table>