{if $user->hasPerm('viewcontentlayers')}
<div id="content_pages">
<table border="0" cellspacing="0" cellpadding="0" class="adminList" style="clear: both; float: left;">
	<tr>
		<th valign="center">URL Key</th>
		<th valign="center">Last Updated</th>
		<th valign="center" style="width: 60px">Published</th>
		{if $hasRestriction}
		<th valign="center" style="width: 80px">Access **</th>
		{/if}
		<th valign="center">Actions ***</th> 
	</tr>
{foreach from=$pages item=page}
	<tr class="{cycle values="row1,row2"}">
		<td>{$page->getPageName()}{$module->trigger('showContentName')}</td>
		<td>{$page->getTimestamp()|date_format:"%B %e, %Y at %T %Z"}</td>
		<td>
			{if $page->getStatus()}
				<img id="status" src="/images/admin/tick.gif" />
			{else}
				<img id="status" src="/images/admin/cross.gif" />
			{/if}
		</td>
		{if $hasRestriction}
		<td>
			<form action="/admin/Content" class="toggle" method="post" onsubmit="return !formSubmit(this);" style="float: left;">
				<input type="hidden" name="section" value="toggle" />
				<input type="hidden" name="id" value="{$page->getId()}" />
				<input type="image" src="/images/admin/{if $page->getAccess() == 'restricted'}delete.png{else}accept.png{/if}" />
			</form>
		</td>
		{/if}
		<td class="actions">
			{if $user->hasPerm('viewcontentlayers')}
			<form method="POST" action="/admin/Content">
				<input type="hidden" name="id" value="{$page->getId()}" />
				<input type="hidden" name="section" value="viewLayers" />
				<input type="image" name="layers" id="layers" value="viewLayers" src="/images/admin/layout_edit.png" />
			</form>
			{/if}
			{*
			<form method="POST" action="/admin/Content">
				<input type="hidden" name="id" value="{$page->getId()}" />
				<input type="hidden" name="section" value="previewPage" />
				<input type="image" name="preview" id="preview" value="preview" src="/images/admin/preview.gif" />
			</form>
			*}
			{if $user->hasPerm('deletecontentpages')}
			<form method="POST" action="/admin/Content" onsubmit="return deleteConfirm({$page->getId()})">
				<input type="hidden" name="id" value="{$page->getId()}" />
				<input type="hidden" name="section" value="deletePage" />
				<input type="image" name="delete" id="delete" value="delete" src="/images/admin/page_delete.gif" />
			</form>
			{/if}
			{$module->trigger('showContentActions', $page->getId())}
		</td>
	</tr>
{/foreach}
	<tr>
		<td colspan="5" class="legend">
			<strong>* Active:</strong><br>
			click icon to change<br>
			Currently active page <img src="/images/admin/tick.gif"><br>
			Inactive page <img src="/images/admin/cross.gif"><br><br>
			{if $hasRestriction}
			<strong>**Access:</strong><br />
			click icon to change<br />
			Currently publicly accessible<img id="access" src="/images/admin/accept.png" /><br />
			Currently restricted access<img id="access" src="/images/admin/delete.png" /><br /><br />
			{/if}
			<strong>*** Actions:</strong><br>
			Revision List <img src="/images/admin/layout_edit.png" alt="View Revision List"><br>
			<!--  Preview Page <img src="/images/admin/preview.gif" alt="Preview this page"><br> !-->

			Archive Page <img src="/images/admin/page_delete.gif" alt="Archive Page">{strip}
			{$module->trigger('showContentFooter')}{/strip}
		</td>
	</tr>
</table>
</div>
{/if}