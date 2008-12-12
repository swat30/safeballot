<?php /* Smarty version 2.6.21-dev, created on 2008-08-26 12:06:00
         compiled from db:menu_rendertop.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'db:menu_rendertop.tpl', 14, false),)), $this); ?>
<div id="nav">
	<ul id="navUl">
	<?php $this->assign('menuCount', 0); ?>
	<?php $_from = $this->_tpl_vars['menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		<?php $this->assign('menuCount', $this->_tpl_vars['menuCount']+1); ?>
		<?php echo '<li><a href="'; ?><?php echo $this->_tpl_vars['item']->link; ?><?php echo '"'; ?><?php if ($this->_tpl_vars['item']->target == 'new'): ?><?php echo ' target="_blank"'; ?><?php endif; ?><?php echo '>'; ?><?php echo $this->_tpl_vars['item']->display; ?><?php echo '</a>'; ?><?php if ($this->_tpl_vars['item']->children): ?><?php echo ''; ?><?php $this->assign('children', true); ?><?php echo '<ul>'; ?><?php else: ?><?php echo ''; ?><?php $this->assign('children', false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php $_from = $this->_tpl_vars['item']->children; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?><?php echo ''; ?><?php $this->assign('depth', 1); ?><?php echo ''; ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "db:menu_renderitems.tpl", 'smarty_include_vars' => array('menu' => 'item')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php echo ''; ?><?php endforeach; endif; unset($_from); ?><?php echo ''; ?><?php if ($this->_tpl_vars['children']): ?><?php echo '</ul>'; ?><?php endif; ?><?php echo '</li>'; ?><?php if ($this->_tpl_vars['menuCount'] < count($this->_tpl_vars['menu'])): ?><?php echo '<li class="menuDivider">&nbsp;</li>'; ?><?php endif; ?><?php echo ''; ?>

		<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>
