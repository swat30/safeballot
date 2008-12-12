<script>
{literal}
function deleteConfirm(id) {
	if (confirm("Are you sure you want to delete this page? Deletion is unrecoverable.")) {
		return true;
	}
	return false;
}
{/literal}
</script>

<h3>Manage Page Content</h3>

{if $user->hasPerm('addcontentpages')}
<div style="float: right;">
		<a href="/admin/Content&section=wizard" title="Create New Content Page">Add Content Page</a>
	</div>
{/if}

<p>This interface allows you to manage your page content.</p>
{$module->trigger('showContentHeader')}
{include file="admin/content_table.tpl"}
