<?php /* Smarty version 2.6.21-dev, created on 2008-11-28 10:58:07
         compiled from blocks.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'blocks.tpl', 5, false),)), $this); ?>
<?php $this->assign('blockcount', 0); ?>
<?php $_from = $this->_tpl_vars['blocks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['block']):
?>
	<?php $this->assign('blockcount', $this->_tpl_vars['blockcount']+1); ?>
	<?php echo $this->_tpl_vars['block']->getContent(); ?>

	<?php if ($this->_tpl_vars['blockcount'] < count($this->_tpl_vars['blocks'])): ?>
		<div class="hr">&nbsp;</div>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>