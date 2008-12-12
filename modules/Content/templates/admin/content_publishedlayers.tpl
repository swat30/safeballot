<table border="0" cellspacing="0" cellpadding="0" class="adminList" style="clear: both; float: left;">
	<tr>
		<th valign="center">Last Updated</th>
		<th valign="center"style="width: 160px">Language</th>
		<th valign="center" style="width: 60px">Published</th>
		<th valign="center" style="width: 80px">Actions **</th> 
	</tr>
{foreach from=$published item=layer}
	<tr class="{cycle values="row1,row2"}">
		<td>{if $layer.status}<strong>{/if}{$layer.timestamp|date_format:"%B %e, %Y at %T %Z"}{if $layer.status}</strong>{/if}</td>
		<td>{if $layer.status}<strong>{/if}{$layer.locale}{if $layer.status}</strong>{/if}</td>
		<td>
			<form method="POST" action="/admin/Content">
				<input type="hidden" name="id" value="{$layer.id}" />
				<input type="hidden" name="section" value="viewLayers" />
				<input type="hidden" name="action" value="toggleStatus" />
				{if $layer.status}
					<input type="image" name="status" id="status" class="status" value="status" src="/images/admin/tick.gif" 
						onclick="HTML_AJAX.replace('active','/modules/Content/AJAX_layers.php?section=active&action=toggleStatus&id={$layer.id}&parent_id={$parent_id}'); HTML_AJAX.replace('inactive','/modules/Content/AJAX_layers.php?section=inactive&parent_id={$parent_id}'); return false;" />
				{else}
					<input type="image" name="status" id="status" value="status" src="/images/admin/cross.gif" 
						onclick="HTML_AJAX.replace('active','/modules/Content/AJAX_layers.php?section=active&action=toggleStatus&id={$layer.id}&parent_id={$parent_id}'); HTML_AJAX.replace('inactive','/modules/Content/AJAX_layers.php?section=inactive&parent_id={$parent_id}'); return false;" />
				{/if}
			</form>
		</td>
		<td class="actions">
			{if $user->hasPerm('editcontent')}
			<form method="POST" action="/admin/Content">
				<input type="hidden" name="id" value="{$layer.id}" />
				<input type="hidden" name="action" value="createRev" />
				<input type="hidden" name="section" value="addEdit" />
				<input type="image" name="layers" id="layers" value="viewLayers" src="/images/admin/pencil.gif" />
			</form>
			<form method="POST" action="/admin/Content">
				<input type="hidden" name="id" value="{$layer.id}" />
				<input type="hidden" name="action" value="editMeta" />
				<input type="hidden" name="section" value="addEdit" />
				<input type="image" name="meta" id="meta" value="editMeta" src="/images/admin/world_link.png" />
			</form>
			{/if}
			<form method="POST" action="/admin/Content">
				<input type="hidden" name="id" value="{$layer.id}" />
				<input type="hidden" name="action" value="viewRev" />
				<input type="hidden" name="section" value="viewRev" />
				<input type="image" name="preview" id="preview" value="preview" src="/images/admin/preview.gif" />
			</form>
			<form method="POST" action="/admin/Content">
				<input type="hidden" name="id" value="{$layer.id}" />
				<input type="hidden" name="action" value="deleteRev" />
				<input type="hidden" name="section" value="viewLayers" />
				<input type="image" name="delete" id="delete" value="delete" src="/images/admin/page_delete.gif" />
			</form>
		</td>
	</tr>
{foreachelse}
	<tr>
		<td colspan="4">{t}There are currently no published layers.{/t}</td>
	</td>
{/foreach}
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>	
</table>

