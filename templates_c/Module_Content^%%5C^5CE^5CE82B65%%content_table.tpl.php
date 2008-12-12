<?php /* Smarty version 2.6.21-dev, created on 2008-08-26 12:03:01
         compiled from admin/content_table.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'admin/content_table.tpl', 14, false),array('modifier', 'date_format', 'admin/content_table.tpl', 16, false),)), $this); ?>
<?php if ($this->_tpl_vars['user']->hasPerm('viewcontentlayers')): ?>
<div id="content_pages">
<table border="0" cellspacing="0" cellpadding="0" class="adminList" style="clear: both; float: left;">
	<tr>
		<th valign="center">URL Key</th>
		<th valign="center">Last Updated</th>
		<th valign="center" style="width: 60px">Published</th>
		<?php if ($this->_tpl_vars['hasRestriction']): ?>
		<th valign="center" style="width: 80px">Access **</th>
		<?php endif; ?>
		<th valign="center">Actions ***</th> 
	</tr>
<?php $_from = $this->_tpl_vars['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
	<tr class="<?php echo smarty_function_cycle(array('values' => "row1,row2"), $this);?>
">
		<td><?php echo $this->_tpl_vars['page']->getPageName(); ?>
<?php echo $this->_tpl_vars['module']->trigger('showContentName'); ?>
</td>
		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['page']->getTimestamp())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%B %e, %Y at %T %Z") : smarty_modifier_date_format($_tmp, "%B %e, %Y at %T %Z")); ?>
</td>
		<td>
			<?php if ($this->_tpl_vars['page']->getStatus()): ?>
				<img id="status" src="/images/admin/tick.gif" />
			<?php else: ?>
				<img id="status" src="/images/admin/cross.gif" />
			<?php endif; ?>
		</td>
		<?php if ($this->_tpl_vars['hasRestriction']): ?>
		<td>
			<form action="/admin/Content" class="toggle" method="post" onsubmit="return !formSubmit(this);" style="float: left;">
				<input type="hidden" name="section" value="toggle" />
				<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['page']->getId(); ?>
" />
				<input type="image" src="/images/admin/<?php if ($this->_tpl_vars['page']->getAccess() == 'restricted'): ?>delete.png<?php else: ?>accept.png<?php endif; ?>" />
			</form>
		</td>
		<?php endif; ?>
		<td class="actions">
			<?php if ($this->_tpl_vars['user']->hasPerm('viewcontentlayers')): ?>
			<form method="POST" action="/admin/Content">
				<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['page']->getId(); ?>
" />
				<input type="hidden" name="section" value="viewLayers" />
				<input type="image" name="layers" id="layers" value="viewLayers" src="/images/admin/layout_edit.png" />
			</form>
			<?php endif; ?>
						<?php if ($this->_tpl_vars['user']->hasPerm('deletecontentpages')): ?>
			<form method="POST" action="/admin/Content" onsubmit="return deleteConfirm(<?php echo $this->_tpl_vars['page']->getId(); ?>
)">
				<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['page']->getId(); ?>
" />
				<input type="hidden" name="section" value="deletePage" />
				<input type="image" name="delete" id="delete" value="delete" src="/images/admin/page_delete.gif" />
			</form>
			<?php endif; ?>
			<?php echo $this->_tpl_vars['module']->trigger('showContentActions',$this->_tpl_vars['page']->getId()); ?>

		</td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
	<tr>
		<td colspan="5" class="legend">
			<strong>* Active:</strong><br>
			click icon to change<br>
			Currently active page <img src="/images/admin/tick.gif"><br>
			Inactive page <img src="/images/admin/cross.gif"><br><br>
			<?php if ($this->_tpl_vars['hasRestriction']): ?>
			<strong>**Access:</strong><br />
			click icon to change<br />
			Currently publicly accessible<img id="access" src="/images/admin/accept.png" /><br />
			Currently restricted access<img id="access" src="/images/admin/delete.png" /><br /><br />
			<?php endif; ?>
			<strong>*** Actions:</strong><br>
			Revision List <img src="/images/admin/layout_edit.png" alt="View Revision List"><br>
			<!--  Preview Page <img src="/images/admin/preview.gif" alt="Preview this page"><br> !-->

			Archive Page <img src="/images/admin/page_delete.gif" alt="Archive Page"><?php echo ''; ?><?php echo $this->_tpl_vars['module']->trigger('showContentFooter'); ?><?php echo ''; ?>

		</td>
	</tr>
</table>
</div>
<?php endif; ?>