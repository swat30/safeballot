<?php /* Smarty version 2.6.21-dev, created on 2008-08-26 12:03:01
         compiled from admin/content.tpl */ ?>
<script>
<?php echo '
function deleteConfirm(id) {
	if (confirm("Are you sure you want to delete this page? Deletion is unrecoverable.")) {
		return true;
	}
	return false;
}
'; ?>

</script>

<h3>Manage Page Content</h3>

<?php if ($this->_tpl_vars['user']->hasPerm('addcontentpages')): ?>
<div style="float: right;">
		<a href="/admin/Content&section=wizard" title="Create New Content Page">Add Content Page</a>
	</div>
<?php endif; ?>

<p>This interface allows you to manage your page content.</p>
<?php echo $this->_tpl_vars['module']->trigger('showContentHeader'); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/content_table.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>