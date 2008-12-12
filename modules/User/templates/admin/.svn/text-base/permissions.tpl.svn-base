<div id="permissions">
{include file="admin/subnav.tpl"}
<form method="post" action="/admin/User">
	<select name="group_view" onchange="return !selectGroup(this)" id="group_select">
		<option value="">[All]</option>
		{foreach from=$groupsView item=group}
			<option value="{$group->getId()}"{if $selectedGroup == $group->getId()} selected{/if}>{$group->getName()}</option>
		{/foreach}
	</select>
</form>

<table class="adminList" cellspacing="0" cellpadding="0" border="0" style="clear: both; float: left;" id="permissions_table">
<thead>
	<tr>
		<th style="width: 350px;">Permission</th>
		{foreach from=$groups item=group}
		<th>{$group->getName()}</th>
		{/foreach}
	</tr>
</thead>
	{foreach from=$permissions item=perm}
	<tr class="{cycle values="row1,row2"}" style="width: 275px;">
		<td>{$perm->getTitle()}</td>
		{foreach from=$groups item=group}
		<td>
		<form method="post" action="/admin/User" onsubmit="return !submitPermissions(this);">
			<input type="hidden" name="section" value="permissions" />
			<input type="hidden" name="perm" value="{$perm->getId()}" />
			<input type="hidden" name="group" value="{$group->getId()}" />  
			<input type="hidden" name="group_view" value="{$selectedGroup}" />  
			{if $group->hasPerm($perm->getKey())}
			<input name="togglePerm" id="togglePerm" value="true" src="/images/admin/tick.gif" type="image" />
			{else}
			<input name="togglePerm" id="togglePerm" value="false" src="/images/admin/cross.gif" type="image" />
			{/if}
		</form>
		</td>
		{/foreach}
	</tr>
	{/foreach}
</table>
</div>