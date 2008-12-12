<?php /* Smarty version 2.6.21-dev, created on 2008-09-12 07:57:32
         compiled from admin/user_table.tpl */ ?>
<?php echo $this->_tpl_vars['module']->trigger('showUserHeader'); ?>


<!-- 
<form>
<input type="checkbox" name="toggle_disabled_user" id="toggle_disabled_user" /> Hide Disabled Users
</form>
 -->

<table class="adminList tablesorter" cellspacing="0" cellpadding="0" border="0" style="clear: both; float: left;">
<thead>
	<tr>
		<th>Username</th>
		<th>Name</th>
		<th>Email</th>
		<th>User Type</th>
		<th>Status</th>
		<th>Actions *</th> 
	</tr>
</thead>
<tbody>
<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/user_item_row.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endforeach; endif; unset($_from); ?>
</tbody>
	<tr>
		<td colspan="5" class="legend" id="help" style="text-align: left;" valign="top"></td>
		<td colspan="1" class="legend">
			<strong>* Actions:</strong><br />
			Edit Item Details <img src="/images/admin/pencil.gif" alt="Edit Item Details"><br />
			Delete Item <img src="/images/admin/cross.gif" alt="Delete Item">
<?php echo ''; ?><?php echo $this->_tpl_vars['module']->trigger('showUserFooter'); ?><?php echo ''; ?>

		</td>
	</tr>
</table>