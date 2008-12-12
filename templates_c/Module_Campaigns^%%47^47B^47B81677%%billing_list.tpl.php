<?php /* Smarty version 2.6.21-dev, created on 2008-08-26 12:36:09
         compiled from admin/billing_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'admin/billing_list.tpl', 8, false),)), $this); ?>
<table border="0" cellspacing="0" cellpadding="0" class="adminList" style="clear: both; float: left; padding-bottom: 5px;">
	<tr>
		<th valign="center">Client</th>
		<th valign="center" style="width: 90px">Billing Status</th>
		<th valign="center" style="width: 150px">Actions ***</th> 
	</tr>
<?php $_from = $this->_tpl_vars['groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['group']):
?>
	<tr class="<?php echo smarty_function_cycle(array('values' => "row1,row2"), $this);?>
">
		<td><?php echo $this->_tpl_vars['group']->getName(); ?>
</td>
		<td>
			<form action="/admin/Campaigns&section=listbilling" class="toggle" method="post" onsubmit="return !formSubmit(this);" style="float: left;">
				<input type="hidden" name="section" value="togglestatus" />
				<input type="hidden" name="group_id" value="<?php echo $this->_tpl_vars['group']->getId(); ?>
" />
				<input type="image" src="/images/admin/<?php if ($this->_tpl_vars['group']->getStatus() > 0): ?>accept.png<?php else: ?>money_delete.png<?php endif; ?>" />
			</form>
		</td>
		<td>
			<form action="/admin/Campaigns" method="post" style="float: left;">
				<input type="hidden" name="section" value="viewbilling" />
				<input type="hidden" name="group_id" value="<?php echo $this->_tpl_vars['group']->getId(); ?>
" />
				<input type="image" src="/images/admin/report_go.png" />
			</form>
		</td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
</table>