<tr class="{cycle values="row1,row2"} {if $user->getActiveStatus() == 1}user_active{else}user_disabled{/if}">
		<td>
			{$user->getUsername()|escape}
			{$module->trigger('showUserName')}
		</td>
		<td>{$user->getName()|escape}</td>
		<td>{$user->getEmail()|escape}</td>
		<td>{$user->getAuthGroupName()}</td>
		<td>{if $user->getActiveStatus() == 1}
			Active
			{else}
			Disabled
			{/if}
		</td>
		<td class="actions">
			<form method="POST" action="/admin/User" onsubmit="return !showAddEdit(this)">
				<input type="hidden" name="id" value="{$user->getId()}" />
				<input type="hidden" name="section" value="addedit" />
				<input type="image" name="edit" id="edit" value="edit" src="/images/admin/pencil.gif" />
			</form>
			<form method="POST" action="/admin/User" onsubmit="return !deleteConfirm(this);">
				<input type="hidden" name="id" value="{$user->getId()}" />
				<input type="hidden" name="section" value="deleteUser" />
				<input type="image" name="delete" id="delete" value="delete" src="/images/admin/cross.gif" />
			</form>
			{$module->trigger('showUserActions')}
		</td>
</tr>