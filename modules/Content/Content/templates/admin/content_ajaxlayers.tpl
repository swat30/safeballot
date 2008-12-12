<p>
{if $page_numbers.total > 1}
Page <strong>{$page_numbers.current}</strong> of <strong>{$page_numbers.total}</strong>: &nbsp; {$pager_links}
{/if}
</p>
<table border="0" cellspacing="0" cellpadding="0" class="adminList" style="clear: both; float: left;">
	<tr>
		<th valign="center">Last Updated</th>
		<th valign="center"style="width: 160px">Language</th>
		<th valign="center" style="width: 60px">Published</th>
		<th valign="center" style="width: 60px">Actions **</th> 
	</tr>
{foreach from=$layers item=layer}
	<tr class="{cycle values="row1,row2"}">
		<td>{if $layer.status}<strong>{/if}{$layer.timestamp|date_format:"%B %e, %Y at %T %Z"}{if $layer.status}</strong>{/if}</td>
		<td>{if $layer.status}<strong>{/if}{$layer.locale}{if $layer.status}</strong>{/if}</td>
		<td>
			<form method="POST" action="/admin/Content">
				<input type="hidden" name="id" value="{$layer.id}" />
				<input type="hidden" name="section" value="viewLayers" />
				<input type="hidden" name="action" value="toggleStatus" />
				{if $layer.status}
					<input type="image" name="status" id="status" value="status" src="/images/admin/tick.gif" 
						onclick="
							HTML_AJAX.replace('inactive','/modules/Content/AJAX_layers.php?section=inactive&action=setActiveRev&id={$layer.id}&parent_id={$parent_id}&pageID={$page_numbers.current}'); 
							HTML_AJAX.replace('active','/modules/Content/AJAX_layers.php?section=active&parent_id={$parent_id}'); 
							return false;" />
				{else}
					<input type="image" name="status" id="status" value="status" src="/images/admin/cross.gif" 
						onclick="
							HTML_AJAX.replace('inactive','/modules/Content/AJAX_layers.php?section=inactive&action=setActiveRev&id={$layer.id}&parent_id={$parent_id}&pageID={$page_numbers.current}'); 
							HTML_AJAX.replace('active','/modules/Content/AJAX_layers.php?section=active&parent_id={$parent_id}');  
							return false;" />
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
				<input type="image" name="delete" id="delete" value="delete" src="/images/admin/page_delete.gif"
					onclick="HTML_AJAX.replace('inactive','/modules/Content/AJAX_layers.php?section=inactive&action=deleteRev&id={$layer.id}&parent_id={$parent_id}&pageID={$page_numbers.current}'); return false;" />
			</form>
		</td>
	</tr>
{/foreach}
	<tr>
		<td class="legend" id="help" valign="top" style="text-align: left;">
		</td>
		<td colspan="3" class="legend">
			<strong>* {t}Published{/t}:</strong><br>
			{t}click icon to change{/t}<br>
			{t}Currently published version{/t} <img src="/images/admin/tick.gif"><br>
			{t}Unpublished version{/t} <img src="/images/admin/cross.gif"><br><br>
		
			<strong>** {t}Actions{/t}:</strong><br />

			{t}Create new version of page from this one{/t} <img src="/images/admin/pencil.gif"><br />
			{t}Preview this revision{/t} <img src="/images/admin/preview.gif" alt="{t}Preview this revision{/t}" /><br />
			{t}Archive this revision{/t} <img src="/images/admin/page_delete.gif" alt="{t}Archive this revision{/t}">
		</td>
	</tr>
</table>
