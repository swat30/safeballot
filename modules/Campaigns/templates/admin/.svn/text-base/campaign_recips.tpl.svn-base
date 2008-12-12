<h3>Manage <i>{$user->getAuthGroupName()}</i> Recipients (<a href="/admin/Campaigns" title="Back">Back</a>)</h3>

<div style="float: left;">
	
</div>
{if $user->hasPerm('addcampaign')}
<div id="header">
	<ul id="primary">
		<li><a href="/admin/Campaigns&section=recipaddedit" title="Add Recipient">Add a New Recipient</a></li>
	</ul>
</div>

{/if}

<table border="0" cellspacing="0" cellpadding="0" class="adminList" style="clear: both; float: left; padding-bottom: 5px;">
	<tr>
		<th valign="center">Name</th>
		<th valign="center" style="width: 250px">E-mail</th>
		<th valign="center" style="width: 150px">Actions ***</th> 
	</tr>
	{foreach from=$recipients item=recipient}
		<tr class="{cycle values="row1,row2"}">
			<td>{$recipient->getName()}</td>
			<td>{$recipient->getEmail()}</td>
			<td>
			{if $user->hasPerm('addcampaign')}
				<form action="/admin/Campaigns" method="post" style="float: left;" onsubmit="return !thickboxAddEdit(this);">
					<input type="hidden" name="section" value="recipaddedit" />
					<input type="hidden" name="recipient_id" value="{$recipient->getId()}" />
					<input type="image" src="/images/admin/user_edit.png" />
				</form>
				<form method="POST" action="/admin/Campaigns" onsubmit="return !deleteConfirm({$recipient->getId()})">
					<input type="hidden" name="id" value="{$recipient->getId()}" />
					<input type="hidden" name="section" value="recipdelete" />
					<input type="hidden" name="group_id" value="{$user->getAuthGroup()}" />
					<input type="image" name="delete" id="delete" value="delete" src="/images/admin/user_delete.png" />
				</form>
			{else}
				&nbsp;
			{/if}
			</td>
		</tr>
	{foreachelse}
		<tr class="{cycle values="row1,row2"}">
			<td colspan="3">None</td>
		</tr>
	{/foreach}
</table>