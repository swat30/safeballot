<h3>Manage <i>{$group->getName()}</i> Billing (<a href="/admin/Campaigns&section=listbilling" title="Back">Back</a>)</h3>
<table border="0" cellspacing="0" cellpadding="0" class="adminList" style="clear: both; float: left; padding-bottom: 5px;">
	<tr>
		<th valign="center">Campaign</th>
		<th valign="center" style="width: 250px">Status</th>
		<th valign="center" style="width: 200px">User Count</th> 
	</tr>
	{foreach from=$campaigns item=campaign}
		<tr class="{cycle values="row1,row2"}">
			<td>{$campaign->getName()}</td>
			<td>{$campaign->getStatus()}</td>
			<td>{$campaign->userCount()}</td>
		</tr>
	{foreachelse}
		<tr class="{cycle values="row1,row2"}">
			<td colspan="3">None</td>
		</tr>
	{/foreach}
</table>