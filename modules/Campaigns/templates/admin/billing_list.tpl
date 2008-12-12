<table border="0" cellspacing="0" cellpadding="0" class="adminList" style="clear: both; float: left; padding-bottom: 5px;">
	<tr>
		<th valign="center">Client</th>
		<th valign="center" style="width: 90px">Billing Status</th>
		<th valign="center" style="width: 150px">Actions ***</th> 
	</tr>
{foreach from=$groups item=group}
	<tr class="{cycle values="row1,row2"}">
		<td>{$group->getName()}</td>
		<td>
			<form action="/admin/Campaigns&section=listbilling" class="toggle" method="post" onsubmit="return !formSubmit(this);" style="float: left;">
				<input type="hidden" name="section" value="togglestatus" />
				<input type="hidden" name="group_id" value="{$group->getId()}" />
				<input type="image" src="/images/admin/{if $group->getStatus() > 0}accept.png{else}money_delete.png{/if}" />
			</form>
		</td>
		<td>
			<form action="/admin/Campaigns" method="post" style="float: left;">
				<input type="hidden" name="section" value="viewbilling" />
				<input type="hidden" name="group_id" value="{$group->getId()}" />
				<input type="image" src="/images/admin/report_go.png" />
			</form>
		</td>
	</tr>
{/foreach}
</table>