<?php /* Smarty version 2.6.21-dev, created on 2008-08-26 12:11:06
         compiled from admin/menu_item_row.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'admin/menu_item_row.tpl', 1, false),array('modifier', 'indent', 'admin/menu_item_row.tpl', 4, false),)), $this); ?>
<tr class="<?php echo smarty_function_cycle(array('values' => "row1,row2"), $this);?>
" id="<?php echo $this->_tpl_vars['item']->getId(); ?>
">
		<td>
			<div class="indent">
			<?php echo ((is_array($_tmp="")) ? $this->_run_mod_handler('indent', true, $_tmp, $this->_tpl_vars['item']->depth, "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;") : smarty_modifier_indent($_tmp, $this->_tpl_vars['item']->depth, "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;")); ?>

			</div>
			<div class="sort_buttons">
				<?php if (! $this->_tpl_vars['item']->bottom): ?>
					<a href="javascript:HTML_AJAX.replace('menu_table', '/admin/Menu&section=menuTable&direction=down&id=<?php echo $this->_tpl_vars['item']->getId(); ?>
')" title="Move Item Down">
						<img src="/images/admin/arrow_down.gif" alt="Move Item Down" />
					</a>
				<?php else: ?>
					<img src="/images/spacer.gif" width="10px" />
				<?php endif; ?>

				<?php if (! $this->_tpl_vars['item']->top): ?>
					<a href="javascript:HTML_AJAX.replace('menu_table', '/admin/Menu&section=menuTable&direction=up&id=<?php echo $this->_tpl_vars['item']->getId(); ?>
')" title="Move Item Up">
						<img src="/images/admin/arrow_up.gif" alt="Move Item Up" />
					</a>
				<?php else: ?>
					<img src="/images/spacer.gif" width="10px" />
				<?php endif; ?>
			</div>
			<div class="menuItemName"><?php echo $this->_tpl_vars['item']->display; ?>
</div>
			<?php echo $this->_tpl_vars['module']->trigger('showMenuName'); ?>

		</td>
		<td><?php echo $this->_tpl_vars['item']->linkType; ?>
: <a href="<?php echo $this->_tpl_vars['item']->link; ?>
"><?php echo $this->_tpl_vars['item']->link; ?>
</a></td>
		<td class="opensIn"><?php if ($this->_tpl_vars['item']->target == 'same'): ?>Same Window<?php else: ?>New Window<?php endif; ?></td>
		<td style="text-align: center;">
			<?php if ($this->_tpl_vars['item']->status == 'active'): ?>
				<a href="javascript:HTML_AJAX.replace('menu_table', '/admin/Menu&section=menuTable&toggleActive&id=<?php echo $this->_tpl_vars['item']->getId(); ?>
')"><img id="status" src="/images/admin/tick.gif" /></a>
			<?php else: ?>
				<a href="javascript:HTML_AJAX.replace('menu_table', '/admin/Menu&section=menuTable&toggleActive&id=<?php echo $this->_tpl_vars['item']->getId(); ?>
')"><img id="status" src="/images/admin/cross.gif" /></a>
			<?php endif; ?>
		</td>
		<td class="actions">
			<form method="POST" action="/admin/Menu">
				<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['item']->getId(); ?>
" />
				<input type="hidden" name="section" value="addedit" />
				<input type="image" name="edit" id="edit" value="edit" src="/images/admin/pencil.gif" />
			</form>
			<form method="POST" action="/admin/Menu" onsubmit="return deleteConfirm(<?php echo $this->_tpl_vars['item']->getId(); ?>
)">
				<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['item']->getId(); ?>
" />
				<input type="hidden" name="section" value="deleteMenuItem" />
				<input type="image" name="delete" id="delete" value="delete" src="/images/admin/page_delete.gif" />
			</form>
			<?php echo $this->_tpl_vars['module']->trigger('showMenuActions'); ?>

		</td>
</tr>
<?php $_from = $this->_tpl_vars['item']->children; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['child']):
?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/menu_item_row.tpl", 'smarty_include_vars' => array('item' => $this->_tpl_vars['child'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endforeach; endif; unset($_from); ?>