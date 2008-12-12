<?php /* Smarty version 2.6.21-dev, created on 2008-09-12 07:57:36
         compiled from admin/permissions.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'admin/permissions.tpl', 22, false),)), $this); ?>
<div id="permissions">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/subnav.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form method="post" action="/admin/User">
	<select name="group_view" onchange="return !selectGroup(this)" id="group_select">
		<option value="">[All]</option>
		<?php $_from = $this->_tpl_vars['groupsView']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['group']):
?>
			<option value="<?php echo $this->_tpl_vars['group']->getId(); ?>
"<?php if ($this->_tpl_vars['selectedGroup'] == $this->_tpl_vars['group']->getId()): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['group']->getName(); ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select>
</form>

<table class="adminList" cellspacing="0" cellpadding="0" border="0" style="clear: both; float: left;" id="permissions_table">
<thead>
	<tr>
		<th style="width: 350px;">Permission</th>
		<?php $_from = $this->_tpl_vars['groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['group']):
?>
		<th><?php echo $this->_tpl_vars['group']->getName(); ?>
</th>
		<?php endforeach; endif; unset($_from); ?>
	</tr>
</thead>
	<?php $_from = $this->_tpl_vars['permissions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['perm']):
?>
	<tr class="<?php echo smarty_function_cycle(array('values' => "row1,row2"), $this);?>
" style="width: 275px;">
		<td><?php echo $this->_tpl_vars['perm']->getTitle(); ?>
</td>
		<?php $_from = $this->_tpl_vars['groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['group']):
?>
		<td>
		<form method="post" action="/admin/User" onsubmit="return !submitPermissions(this);">
			<input type="hidden" name="section" value="permissions" />
			<input type="hidden" name="perm" value="<?php echo $this->_tpl_vars['perm']->getId(); ?>
" />
			<input type="hidden" name="group" value="<?php echo $this->_tpl_vars['group']->getId(); ?>
" />  
			<input type="hidden" name="group_view" value="<?php echo $this->_tpl_vars['selectedGroup']; ?>
" />  
			<?php if ($this->_tpl_vars['group']->hasPerm($this->_tpl_vars['perm']->getKey())): ?>
			<input name="togglePerm" id="togglePerm" value="true" src="/images/admin/tick.gif" type="image" />
			<?php else: ?>
			<input name="togglePerm" id="togglePerm" value="false" src="/images/admin/cross.gif" type="image" />
			<?php endif; ?>
		</form>
		</td>
		<?php endforeach; endif; unset($_from); ?>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
</table>
</div>