<a href="#" onclick="return showMovie('/modules/Blocks/blocks.flv');">View Help Movie</a>

{if $blocks}
<p style="width: 100%; text-align: right;"><a href="/admin/Blocks&amp;section=addedit">Create Block</a></p>
	<table border="0" cellspacing="0" cellpadding="0" class="adminList" style="clear: both; float: left;">
		<tr>
				<th valign="center">Title *</th>
				<th valign="center" style="width:135px;">Last Updated</th>
				<th valign="center" style="width:100px;">Active? **</th>
				<th valign="center" style="width:150px;">Actions ***</th>
		</tr>
		<tbody>
		{foreach from=$blocks item=block}
		<tr class="{cycle values="row1,row2"}">
			<td>
				<div class="blockTitle">
				{$block->getTitle()|strip_tags|truncate:60}
				</div>

			</td>
			<td>
				<div>
				{$block->getTimestamp()}
				</div>
			</td>
			<td class="center">
				<form action="/admin/Blocks" class="toggle" method="post" onsubmit="return !formSubmit(this);" style="float: left;">
					<input type="hidden" name="section" value="toggle" />
					<input type="hidden" name="id" value="{$block->getId()}" />
					<input type="image" src="/images/admin/{if $block->getStatus() == 'active'}tick.gif{else}cross.gif{/if}" />
				</form>
			<td class="center">
				<form action="/admin/Blocks" method="post" style="float: left;">
					<input type="hidden" name="section" value="addedit" />
					<input type="hidden" name="blocks_id" value="{$block->getId()}" />
					<input type="image" src="/images/admin/pencil.gif" />
				</form>

				<form action="/admin/Blocks" class="delete" method="post" style="float: left;" onsubmit="return !deleteConfirm(this, 'block');">
					<input type="hidden" name="section" value="delete" />
					<input type="hidden" name="blocks_id" value="{$block->getId()}" />
					<input type="image" src="/images/admin/page_delete.gif" />
				</form>
			</td>

		</tr>
		{/foreach}
		</tbody>
		<tr>
		<td colspan="3" class="legend" id="help" style="text-align: left;" valign="top"></td>
		<td colspan="2" class="legend">
			<strong>* Active:</strong><br>
			click icon to change<br>
			Currently active block <img src="/images/admin/tick.gif"><br>
			Inactive block <img src="/images/admin/cross.gif"><br><br>
			<strong>*** Actions:</strong><br />
			Edit Item Details <img src="/images/admin/pencil.gif" alt="Edit Item Details"><br />
			Delete Item <img src="/images/admin/page_delete.gif" alt="Delete Item">
{strip}
			{$module->trigger('showMenuFooter')}{/strip}
		</td>
	</tr>
	</table>
{else}

<div class="roundcont">
   <div class="roundtop">
	 <img src="/images/admin/noAsset_tl.png" alt="" 
	 width="20" height="20" class="corner" 
	 style="display: none" />
   </div>

   <p>No Blocks Created. Would you like to <a href="/admin/Blocks&amp;section=addedit">make one</a>?</p>
  
   <div class="roundbottom">
	 <img src="/images/admin/noAsset_bl.png" alt="" 
	 width="20" height="20" class="corner" 
	 style="display: none" />
   </div>
</div>	

{/if}