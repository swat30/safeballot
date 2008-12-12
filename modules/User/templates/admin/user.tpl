{include file="admin/subnav.tpl"}

<h3>User Management</h3>

<div id="header">
	<ul id="primary">
		<li><a href="/admin/User&section=addedit" title="Create User">Create User</a></li>
	</ul>
</div>

<p>This interface allows you to add and delete users</p>

<div id="user_table">
{include file="admin/user_table.tpl"}
</div>

<div id="thickbox_wrapper" style="display: none;">
	<div id="thickbox_header" style="display: block;">&nbsp;</div>
	<div id="thickbox">&nbsp;</div>
	<div id="thickbox_footer">&nbsp;</div>
</div>