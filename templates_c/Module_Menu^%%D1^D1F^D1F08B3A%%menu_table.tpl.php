<?php /* Smarty version 2.6.21-dev, created on 2008-08-26 12:03:03
         compiled from admin/menu_table.tpl */ ?>
<script>
<?php echo '
function deleteConfirm(id) {
	if (confirm("Are you sure you want to delete this item? Deleting it will also remove all sub-items")) {
		HTML_AJAX.replace(\'menu_table\', \'/admin/Menu&section=deleteMenuItem&id=\' + id);
	}
	return false;
}

'; ?>

</script>
<?php echo $this->_tpl_vars['module']->trigger('showMenuHeader'); ?>

<table border="0" cellspacing="0" cellpadding="0" class="adminList" style="clear: both; float: left;">

	<tr>
		<th valign="center">Menu Item *</th>
		<th valign="center">Links To</th>
		<th valign="center">Opens In</th>
		<th valign="center" style="width: 60px">Active? **</th>
		<th valign="center">Actions ***</th> 
	</tr>
<tbody id="menuTable">
<?php $_from = $this->_tpl_vars['menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/menu_item_row.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endforeach; endif; unset($_from); ?>
</tbody>
	<tr>
		<td colspan="3" class="legend" id="help" style="text-align: left;" valign="top"></td>
		<td colspan="2" class="legend">
			<strong>* Menu Item:</strong><br />
			Move Item Down <img src="/images/admin/arrow_down.gif" alt="Move Item Down"><br />

			Move Item Up <img src="/images/admin/arrow_up.gif" alt="Move Item Up"><br /><br />
			<strong>** Active?:</strong><br />
			click icon to change status<br /><br />
			<strong>*** Actions:</strong><br />
			Edit Item Details <img src="/images/admin/pencil.gif" alt="Edit Item Details"><br />
			Delete Item <img src="/images/admin/cross.gif" alt="Delete Item">
<?php echo ''; ?><?php echo $this->_tpl_vars['module']->trigger('showMenuFooter'); ?><?php echo ''; ?>

		</td>
	</tr>

</table>

<?php echo '
 <script type="text/javascript">
 // <![CDATA[
   Sortable.create("menuTable",
     {tag: "TR", 
     dropOnEmpty:true, 
     containment: ["menuTable"], 
     constraint: false
     });
 // ]]>
 </script>
'; ?>
