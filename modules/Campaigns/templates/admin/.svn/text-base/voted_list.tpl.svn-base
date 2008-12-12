<h3>Checking user voting status on <i>{$campaignName}</i> (<a href="/admin/Campaigns">Go Back</a>)</h3>

<table border="0" cellspacing="0" cellpadding="0" class="adminList" style="clear: both; float: left; padding-bottom: 5px;">
	<tr>
		<th valign="center">Users who have voted</th>
	</tr>
	{foreach from=$votedlist item=voter}
	<tr class="{cycle values="row1,row2"}">
		<td>{$voter->getName()}</td>
	</tr>
	{foreachelse}
	<tr class="{cycle values="row1,row2"}">
		<td>None</td>
	</tr>
	{/foreach}
</table>
<table border="0" cellspacing="0" cellpadding="0" class="adminList" style="clear: both; float: left; padding-bottom: 5px;">
	<tr>
		<th valign="center">Users who have NOT voted</th>
	</tr>
	{foreach from=$notvotedlist item=voter}
	<tr class="{cycle values="row1,row2"}">
		<td>{$voter->getName()}</td>
	</tr>
	{foreachelse}
	<tr class="{cycle values="row1,row2"}">
		<td>None</td>
	</tr>
	{/foreach}
</table>