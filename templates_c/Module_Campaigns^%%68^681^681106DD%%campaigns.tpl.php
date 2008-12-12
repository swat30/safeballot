<?php /* Smarty version 2.6.21-dev, created on 2008-09-19 14:23:11
         compiled from admin/campaigns.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'admin/campaigns.tpl', 16, false),)), $this); ?>
<h3>Manage <i><?php echo $this->_tpl_vars['user']->getAuthGroupName(); ?>
</i> Campaigns (<a href="/admin/Campaigns&section=reciplist">Manage Users</a>)</h3>

<?php if ($this->_tpl_vars['user']->hasPerm('addcampaign')): ?>
<div style="float: right;">
		<a href="/admin/Campaigns&section=addedit" title="Create New Campaign">Create Campaign</a>
	</div>
<?php endif; ?>

<table border="0" cellspacing="0" cellpadding="0" class="adminList" style="clear: both; float: left; padding-bottom: 5px;">
	<tr>
		<th valign="center">Upcoming Campaigns</th>
		<th valign="center" style="width: 200px">Status</th>
		<th valign="center" style="width: 150px">Actions ***</th> 
	</tr>
	<?php $_from = $this->_tpl_vars['campaigns']['upcoming']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['campaign']):
?>
		<tr class="<?php echo smarty_function_cycle(array('values' => "row1,row2"), $this);?>
">
			<td><?php echo $this->_tpl_vars['campaign']->getName(); ?>
</td>
			<td><?php echo $this->_tpl_vars['campaign']->getStatus(); ?>
</td>
			<td>
				<form action="/admin/Campaigns" method="post" style="float: left;">
					<input type="hidden" name="section" value="addedit" />
					<input type="hidden" name="campaign_id" value="<?php echo $this->_tpl_vars['campaign']->getId(); ?>
" />
					<input type="image" src="/images/admin/pencil.gif" />
				</form>
				<form action="/admin/Campaigns" method="post" style="float: left;" onsubmit="return !thickboxAddEdit(this)">
					<input type="hidden" name="section" value="questionedit" />
					<input type="hidden" name="campaign_id" value="<?php echo $this->_tpl_vars['campaign']->getId(); ?>
" />
					<input type="image" src="/images/admin/tab_edit.png" />
				</form>
				<form action="/admin/Campaigns" method="post" style="float: left;" onsubmit="return !thickboxAddEdit(this)">
					<input type="hidden" name="section" value="votesend" />
					<input type="hidden" name="campaign_id" value="<?php echo $this->_tpl_vars['campaign']->getId(); ?>
" />
					<input type="image" src="/images/admin/email_go.png" />
				</form>
				<?php if ($this->_tpl_vars['user']->hasPerm('generatereciplist')): ?>
				<form action="/admin/Campaigns" method="post" style="float: left;">
					<input type="hidden" name="section" value="voteprint" />
					<input type="hidden" name="campaign_id" value="<?php echo $this->_tpl_vars['campaign']->getId(); ?>
" />
					<input type="image" src="/images/admin/printer.png" />
				</form>
				<?php endif; ?>
								<form method="POST" action="/admin/Campaigns" onsubmit="return deleteConfirm(<?php echo $this->_tpl_vars['campaign']->getId(); ?>
)">
					<input type="hidden" name="campaign_id" value="<?php echo $this->_tpl_vars['campaign']->getId(); ?>
" />
					<input type="hidden" name="section" value="campaigndelete" />
					<input type="image" name="delete" id="delete" value="delete" src="/images/admin/cross.gif" />
				</form>
			</td>
		</tr>
	<?php endforeach; else: ?>
		<tr class="<?php echo smarty_function_cycle(array('values' => "row1,row2"), $this);?>
">
			<td colspan="3">None</td>
		</tr>
	<?php endif; unset($_from); ?>
</table>
<table border="0" cellspacing="0" cellpadding="0" class="adminList" style="clear: both; float: left; padding-bottom: 5px;">
	<tr>
		<th valign="center">Campaigns in Progress</th>
		<th valign="center" style="width: 250px">Status</th>
		<th valign="center" style="width: 100px">Actions ***</th>
	</tr>
	<?php $_from = $this->_tpl_vars['campaigns']['progress']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['campaign']):
?>
		<tr class="<?php echo smarty_function_cycle(array('values' => "row1,row2"), $this);?>
">
			<td><?php echo $this->_tpl_vars['campaign']->getName(); ?>
</td>
			<td><?php echo $this->_tpl_vars['campaign']->getStatus(); ?>
</td>
			<td>
				<form action="/admin/Campaigns" method="post" style="float: left;" onsubmit="return !thickboxAddEdit(this);">
					<input type="hidden" name="section" value="votesend" />
					<input type="hidden" name="campaign_id" value="<?php echo $this->_tpl_vars['campaign']->getId(); ?>
" />
					<input type="image" src="/images/admin/email_go.png" />
				</form>
				<?php if ($this->_tpl_vars['user']->hasPerm('generatereciplist')): ?>
				<form action="/admin/Campaigns" method="post" style="float: left;">
					<input type="hidden" name="section" value="voteprint" />
					<input type="hidden" name="campaign_id" value="<?php echo $this->_tpl_vars['campaign']->getId(); ?>
" />
					<input type="image" src="/images/admin/printer.png" />
				</form>
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
<table border="0" cellspacing="0" cellpadding="0" class="adminList" style="clear: both; float: left;">
	<tr>
		<th valign="center">Completed Campaigns</th>
		<th valign="center" style="width: 200px">Status</th>
		<th valign="center" style="width: 150px">Actions ***</th> 
	</tr>
	<?php $_from = $this->_tpl_vars['campaigns']['ended']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['campaign']):
?>
		<tr class="<?php echo smarty_function_cycle(array('values' => "row1,row2"), $this);?>
">
			<td><?php echo $this->_tpl_vars['campaign']->getName(); ?>
</td>
			<td><?php echo $this->_tpl_vars['campaign']->getStatus(); ?>
</td>
			<td>
				<form action="/admin/Campaigns" method="post" style="float: left;">
					<input type="hidden" name="section" value="viewresults" />
					<input type="hidden" name="campaign_id" value="<?php echo $this->_tpl_vars['campaign']->getId(); ?>
" />
					<input type="image" src="/images/admin/page_white_magnify.png" />
				</form>
				<form action="/admin/Campaigns" method="post" style="float: left;" onsubmit="return !thickboxAddEdit(this);">
					<input type="hidden" name="section" value="resultsend" />
					<input type="hidden" name="campaign_id" value="<?php echo $this->_tpl_vars['campaign']->getId(); ?>
" />
					<input type="image" src="/images/admin/page_white_go.png" />
				</form>
				<form action="/admin/Campaigns" method="post" style="float: left;">
					<input type="hidden" name="section" value="whovoted" />
					<input type="hidden" name="campaign_id" value="<?php echo $this->_tpl_vars['campaign']->getId(); ?>
" />
					<input type="image" src="/images/admin/user_comment.png" />
				</form>
			</td>
		</tr>
	<?php endforeach; else: ?>
		<tr class="row1">
			<td colspan="3">None</td>
		</tr>
	<?php endif; unset($_from); ?>
</table>