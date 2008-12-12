<?php /* Smarty version 2.6.21-dev, created on 2008-09-12 07:57:32
         compiled from admin/user_item_row.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'admin/user_item_row.tpl', 1, false),array('modifier', 'escape', 'admin/user_item_row.tpl', 3, false),)), $this); ?>
<tr class="<?php echo smarty_function_cycle(array('values' => "row1,row2"), $this);?>
 <?php if ($this->_tpl_vars['user']->getActiveStatus() == 1): ?>user_active<?php else: ?>user_disabled<?php endif; ?>">
		<td>
			<?php echo ((is_array($_tmp=$this->_tpl_vars['user']->getUsername())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

			<?php echo $this->_tpl_vars['module']->trigger('showUserName'); ?>

		</td>
		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['user']->getName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['user']->getEmail())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
		<td><?php echo $this->_tpl_vars['user']->getAuthGroupName(); ?>
</td>
		<td><?php if ($this->_tpl_vars['user']->getActiveStatus() == 1): ?>
			Active
			<?php else: ?>
			Disabled
			<?php endif; ?>
		</td>
		<td class="actions">
			<form method="POST" action="/admin/User" onsubmit="return !showAddEdit(this)">
				<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['user']->getId(); ?>
" />
				<input type="hidden" name="section" value="addedit" />
				<input type="image" name="edit" id="edit" value="edit" src="/images/admin/pencil.gif" />
			</form>
			<form method="POST" action="/admin/User" onsubmit="return !deleteConfirm(this);">
				<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['user']->getId(); ?>
" />
				<input type="hidden" name="section" value="deleteUser" />
				<input type="image" name="delete" id="delete" value="delete" src="/images/admin/cross.gif" />
			</form>
			<?php echo $this->_tpl_vars['module']->trigger('showUserActions'); ?>

		</td>
</tr>