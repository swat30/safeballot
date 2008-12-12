<h1>{$ticket->summary}</h1>

<h3>Status: <span style="color: {if $ticket->resolution->name != 'fixed'}red{else}green{/if};">{$ticket->resolution->name|capitalize}</span></h3>

<p>{$ticket->description}</p>

<p>
<strong>Category:</strong> {$ticket->category}<br />
<strong>Last Updated:</strong> {$ticket->last_updated|date_format:"%c"}<br />
</p>

{if $ticket->notes}
<br /><br />
<h3>Comments</h3>
{foreach from=$ticket->notes item=note}
<p><strong>{$note->reporter->real_name}:</strong> <em>{$note->date_submitted|date_format:"%c"}</em>
<br /> 
{$note->text}</p>
{/foreach}
{/if}