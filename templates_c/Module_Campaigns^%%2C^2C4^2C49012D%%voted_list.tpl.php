<?php /* Smarty version 2.6.21-dev, created on 2008-09-19 14:45:52
         compiled from admin/voted_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'admin/voted_list.tpl', 8, false),)), $this); ?>
<h3>Checking user voting status on <i><?php echo $this->_tpl_vars['campaignName']; ?>
</i> (<a href="/admin/Campaigns">Go Back</a>)</h3>

<table border="0" cellspacing="0" cellpadding="0" class="adminList" style="clear: both; float: left; padding-bottom: 5px;">
	<tr>
		<th valign="center">Users who have voted</th>
	</tr>
	<?php $_from = $this->_tpl_vars['votedlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['voter']):
?>
	<tr class="<?php echo smarty_function_cycle(array('values' => "row1,row2"), $this);?>
">
		<td><?php echo $this->_tpl_vars['voter']->getName(); ?>
</td>
	</tr>
	<?php endforeach; else: ?>
	<tr class="<?php echo smarty_function_cycle(array('values' => "row1,row2"), $this);?>
">
		<td>None</td>
	</tr>
	<?php endif; unset($_from); ?>
</table>
<table border="0" cellspacing="0" cellpadding="0" class="adminList" style="clear: both; float: left; padding-bottom: 5px;">
	<tr>
		<th valign="center">Users who have NOT voted</th>
	</tr>
	<?php $_from = $this->_tpl_vars['notvotedlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['voter']):
?>
	<tr class="<?php echo smarty_function_cycle(array('values' => "row1,row2"), $this);?>
">
		<td><?php echo $this->_tpl_vars['voter']->getName(); ?>
</td>
	</tr>
	<?php endforeach; else: ?>
	<tr class="<?php echo smarty_function_cycle(array('values' => "row1,row2"), $this);?>
">
		<td>None</td>
	</tr>
	<?php endif; unset($_from); ?>
</table>