{$form->display()}

<div style="clear: both;"> </div>

{if $tickets}
<h3>Submitted Bugs:</h3>
<table border="0" cellspacing="0" cellpadding="0" class="adminList" style="clear: both; float: left;">
	<tr>
		<th valign="center">Bug #</th>
		<th valign="center">Title</th>
		<th valign="center">Actions **</th> 
	</tr>
	{foreach from=$tickets item=ticket}
	<tr class="{cycle values="row1,row2"}">
		<td>{$ticket->getTicket_id()}</td>
		<td>{$ticket->getTitle()}</td>
		<td>
			<a href="/admin/Support&section=bug&id={$ticket->getId()}">View Status and Comments</a>
		</td>
	</tr>
	{/foreach}
</table>
{/if}



