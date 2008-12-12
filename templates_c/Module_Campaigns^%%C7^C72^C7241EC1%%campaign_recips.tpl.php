<?php /* Smarty version 2.6.21-dev, created on 2008-08-26 15:03:37
         compiled from admin/campaign_recips.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'admin/campaign_recips.tpl', 22, false),)), $this); ?>
<h3>Manage <i><?php echo $this->_tpl_vars['user']->getAuthGroupName(); ?>
</i> Recipients (<a href="/admin/Campaigns" title="Back">Back</a>)</h3>

<div style="float: left;">
	
</div>
<?php if ($this->_tpl_vars['user']->hasPerm('addcampaign')): ?>
<div id="header">
	<ul id="primary">
		<li><a href="/admin/Campaigns&section=recipaddedit" title="Add Recipient">Add a New Recipient</a></li>
	</ul>
</div>

<?php endif; ?>

<table border="0" cellspacing="0" cellpadding="0" class="adminList" style="clear: both; float: left; padding-bottom: 5px;">
	<tr>
		<th valign="center">Name</th>
		<th valign="center" style="width: 250px">E-mail</th>
		<th valign="center" style="width: 150px">Actions ***</th> 
	</tr>
	<?php $_from = $this->_tpl_vars['recipients']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['recipient']):
?>
		<tr class="<?php echo smarty_function_cycle(array('values' => "row1,row2"), $this);?>
">
			<td><?php echo $this->_tpl_vars['recipient']->getName(); ?>
</td>
			<td><?php echo $this->_tpl_vars['recipient']->getEmail(); ?>
</td>
			<td>
			<?php if ($this->_tpl_vars['user']->hasPerm('addcampaign')): ?>
				<form action="/admin/Campaigns" method="post" style="float: left;" onsubmit="return !thickboxAddEdit(this);">
					<input type="hidden" name="section" value="recipaddedit" />
					<input type="hidden" name="recipient_id" value="<?php echo $this->_tpl_vars['recipient']->getId(); ?>
" />
					<input type="image" src="/images/admin/user_edit.png" />
				</form>
				<form method="POST" action="/admin/Campaigns" onsubmit="return !deleteConfirm(<?php echo $this->_tpl_vars['recipient']->getId(); ?>
)">
					<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['recipient']->getId(); ?>
" />
					<input type="hidden" name="section" value="recipdelete" />
					<input type="hidden" name="group_id" value="<?php echo $this->_tpl_vars['user']->getAuthGroup(); ?>
" />
					<input type="image" name="delete" id="delete" value="delete" src="/images/admin/user_delete.png" />
				</form>
			<?php else: ?>
				&nbsp;
			<?php endif; ?>
			</td>
		</tr>
	<?php endforeach; else: ?>
		<tr class="<?php echo smarty_function_cycle(array('values' => "row1,row2"), $this);?>
">
			<td colspan="3">None</td>
		</tr>
	<?php endif; unset($_from); ?>
</table>