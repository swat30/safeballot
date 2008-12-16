<h3>Viewing <i>{$company}</i> campaign archive (<a href="/admin/Campaigns" title="Back">Go Back</a>)</h3>

<table border="0" cellspacing="0" cellpadding="0" class="adminList" style="clear: both; float: left; padding-bottom: 5px;">
	<tr>
		<th valign="center">Archived Campaigns</th>
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
		</td>
	</tr>
	{/foreach}
</table>