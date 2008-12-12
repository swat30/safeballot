<?php /* Smarty version 2.6.21-dev, created on 2008-08-26 12:36:15
         compiled from admin/billing_view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'admin/billing_view.tpl', 9, false),)), $this); ?>
<h3>Manage <i><?php echo $this->_tpl_vars['group']->getName(); ?>
</i> Billing (<a href="/admin/Campaigns&section=listbilling" title="Back">Back</a>)</h3>
<table border="0" cellspacing="0" cellpadding="0" class="adminList" style="clear: both; float: left; padding-bottom: 5px;">
	<tr>
		<th valign="center">Campaign</th>
		<th valign="center" style="width: 250px">Status</th>
		<th valign="center" style="width: 200px">User Count</th> 
	</tr>
	<?php $_from = $this->_tpl_vars['campaigns']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['campaign']):
?>
		<tr class="<?php echo smarty_function_cycle(array('values' => "row1,row2"), $this);?>
">
			<td><?php echo $this->_tpl_vars['campaign']->getName(); ?>
</td>
			<td><?php echo $this->_tpl_vars['campaign']->getStatus(); ?>
</td>
			<td><?php echo $this->_tpl_vars['campaign']->userCount(); ?>
</td>
		</tr>
	<?php endforeach; else: ?>
		<tr class="<?php echo smarty_function_cycle(array('values' => "row1,row2"), $this);?>
">
			<td colspan="3">None</td>
		</tr>
	<?php endif; unset($_from); ?>
</table>