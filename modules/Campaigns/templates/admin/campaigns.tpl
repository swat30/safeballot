<h3>Manage <i>{$user->getAuthGroupName()}</i> Campaigns</h3>
<div id="header">
	<ul id="primary" class="plain">
	{if $user->hasPerm('addcampaign')}
		<li><a href="/admin/Campaigns&section=addedit" title="Create New Campaign">Create Campaign</a></li>
	{/if}
		<li><a href="/admin/Campaigns&section=viewarchive" title="View Campaign Archives">View Archive</a></li>
		<li><a href="/admin/Campaigns&section=reciplist">Manage Users</a></li>
	</ul>
</div>

<table border="0" cellspacing="0" cellpadding="0" class="adminList" style="clear: both; float: left; padding-bottom: 5px;">
	<tr>
		<th valign="center">Upcoming Campaigns</th>
		<th valign="center" style="width: 200px">Status</th>
		<th valign="center" style="width: 150px">Actions ***</th> 
	</tr>
	{foreach from=$campaigns.upcoming item=campaign}
		<tr class="{cycle values="row1,row2"}">
			<td>{$campaign->getName()}</td>
			<td>{$campaign->getStatus()}</td>
			<td>
				<form action="/admin/Campaigns" method="post" style="float: left;">
					<input type="hidden" name="section" value="addedit" />
					<input type="hidden" name="campaign_id" value="{$campaign->getId()}" />
					<input type="image" src="/images/admin/pencil.gif" title="Edit" />
				</form>
				<form action="/admin/Campaigns" method="post" style="float: left;" onsubmit="return !thickboxAddEdit(this)">
					<input type="hidden" name="section" value="questionedit" />
					<input type="hidden" name="campaign_id" value="{$campaign->getId()}" />
					<input type="image" src="/images/admin/tab_edit.png" title="Edit questions" />
				</form>
				<form action="/admin/Campaigns" method="post" style="float: left;" onsubmit="return !thickboxAddEdit(this)">
					<input type="hidden" name="section" value="votesend" />
					<input type="hidden" name="campaign_id" value="{$campaign->getId()}" />
					<input type="image" src="/images/admin/email_go.png" title="Invite user list to vote" />
				</form>
				{if $user->hasPerm('generatereciplist')}
				<form action="/admin/Campaigns" method="post" style="float: left;">
					<input type="hidden" name="section" value="voteprint" />
					<input type="hidden" name="campaign_id" value="{$campaign->getId()}" />
					<input type="image" src="/images/admin/printer.png" title="Generate hash PDF" />
				</form>
				{/if}
				<form method="POST" action="/admin/Campaigns" onsubmit="return deleteConfirm({$campaign->getId()})">
					<input type="hidden" name="campaign_id" value="{$campaign->getId()}" />
					<input type="hidden" name="section" value="campaigndelete" />
					<input type="image" name="delete" id="delete" value="delete" src="/images/admin/cross.gif" title="Delete campaign" />
				</form>
			</td>
		</tr>
	{foreachelse}
		<tr class="{cycle values="row1,row2"}">
			<td colspan="3">None</td>
		</tr>
	{/foreach}
</table>
<table border="0" cellspacing="0" cellpadding="0" class="adminList" style="clear: both; float: left; padding-bottom: 5px;">
	<tr>
		<th valign="center">Campaigns in Progress</th>
		<th valign="center" style="width: 250px">Status</th>
		<th valign="center" style="width: 100px">Actions ***</th>
	</tr>
	{foreach from=$campaigns.progress item=campaign}
		<tr class="{cycle values="row1,row2"}">
			<td>{$campaign->getName()}</td>
			<td>{$campaign->getStatus()}</td>
			<td>
				<form action="/admin/Campaigns" method="post" style="float: left;" onsubmit="return !thickboxAddEdit(this);">
					<input type="hidden" name="section" value="votesend" />
					<input type="hidden" name="campaign_id" value="{$campaign->getId()}" />
					<input type="image" src="/images/admin/email_go.png" title="Send voting reminder to user list" />
				</form>
				{if $user->hasPerm('generatereciplist')}
				<form action="/admin/Campaigns" method="post" style="float: left;">
					<input type="hidden" name="section" value="voteprint" />
					<input type="hidden" name="campaign_id" value="{$campaign->getId()}" />
					<input type="image" src="/images/admin/printer.png" title="Generate hash PDF" />
				</form>
				{/if}
			</td>
		</tr>
	{foreachelse}
		<tr class="{cycle values="row1,row2"}">
			<td colspan="3">None</td>
		</tr>
	{/foreach}
</table>
<table border="0" cellspacing="0" cellpadding="0" class="adminList" style="clear: both; float: left;">
	<tr>
		<th valign="center">Completed Campaigns</th>
		<th valign="center" style="width: 200px">Status</th>
		<th valign="center" style="width: 150px">Actions ***</th> 
	</tr>
	{foreach from=$campaigns.ended item=campaign}
		<tr class="{cycle values="row1,row2"}">
			<td>{$campaign->getName()}</td>
			<td>{$campaign->getStatus()}</td>
			<td>
				<form action="/admin/Campaigns" method="post" style="float: left;" onsubmit="return !thickboxAddEdit(this);">
					<input type="hidden" name="section" value="viewresults" />
					<input type="hidden" name="campaign_id" value="{$campaign->getId()}" />
					<input type="image" src="/images/admin/page_white_magnify.png" title="View results" />
				</form>
				<form action="/admin/Campaigns" method="post" style="float: left;" onsubmit="return !thickboxAddEdit(this);">
					<input type="hidden" name="section" value="resultsend" />
					<input type="hidden" name="campaign_id" value="{$campaign->getId()}" />
					<input type="image" src="/images/admin/page_white_go.png" title="Send results to user list" />
				</form>
				<form action="/admin/Campaigns" method="post" style="float: left;">
					<input type="hidden" name="section" value="whovoted" />
					<input type="hidden" name="campaign_id" value="{$campaign->getId()}" />
					<input type="image" src="/images/admin/user_comment.png" title="Check individual voting status" />
				</form>
				<form action="/admin/Campaigns" method="post" style="float: left;">
					<input type="hidden" name="section" value="archivecampaign" />
					<input type="hidden" name="campaign_id" value="{$campaign->getId()}" />
					<input type="image" src="/images/admin/folder_table.png" title="Archive" />
				</form>
			</td>
		</tr>
	{foreachelse}
		<tr class="row1">
			<td colspan="3">None</td>
		</tr>
	{/foreach}
</table>