<tr class="{cycle values="row1,row2"}" id="{$item->getId()}">
		<td>
			<div class="indent">
			{""|indent:$item->depth:"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"}
			</div>
			<div class="sort_buttons">
				{if !$item->bottom}
					<a href="javascript:HTML_AJAX.replace('menu_table', '/admin/Menu&section=menuTable&direction=down&id={$item->getId()}')" title="Move Item Down">
						<img src="/images/admin/arrow_down.gif" alt="Move Item Down" />
					</a>
				{else}
					<img src="/images/spacer.gif" width="10px" />
				{/if}

				{if !$item->top}
					<a href="javascript:HTML_AJAX.replace('menu_table', '/admin/Menu&section=menuTable&direction=up&id={$item->getId()}')" title="Move Item Up">
						<img src="/images/admin/arrow_up.gif" alt="Move Item Up" />
					</a>
				{else}
					<img src="/images/spacer.gif" width="10px" />
				{/if}
			</div>
			<div class="menuItemName">{$item->display}</div>
			{$module->trigger('showMenuName')}
		</td>
		<td>{$item->linkType}: <a href="{$item->link}">{$item->link}</a></td>
		<td class="opensIn">{if $item->target == "same"}Same Window{else}New Window{/if}</td>
		<td style="text-align: center;">
			{if $item->status == "active"}
				<a href="javascript:HTML_AJAX.replace('menu_table', '/admin/Menu&section=menuTable&toggleActive&id={$item->getId()}')"><img id="status" src="/images/admin/tick.gif" /></a>
			{else}
				<a href="javascript:HTML_AJAX.replace('menu_table', '/admin/Menu&section=menuTable&toggleActive&id={$item->getId()}')"><img id="status" src="/images/admin/cross.gif" /></a>
			{/if}
		</td>
		<td class="actions">
			<form method="POST" action="/admin/Menu">
				<input type="hidden" name="id" value="{$item->getId()}" />
				<input type="hidden" name="section" value="addedit" />
				<input type="image" name="edit" id="edit" value="edit" src="/images/admin/pencil.gif" />
			</form>
			<form method="POST" action="/admin/Menu" onsubmit="return deleteConfirm({$item->getId()})">
				<input type="hidden" name="id" value="{$item->getId()}" />
				<input type="hidden" name="section" value="deleteMenuItem" />
				<input type="image" name="delete" id="delete" value="delete" src="/images/admin/page_delete.gif" />
			</form>
			{$module->trigger('showMenuActions')}
		</td>
</tr>
{foreach from=$item->children item=child}
	{include file="admin/menu_item_row.tpl" item=$child}
{/foreach}