<?php /* Smarty version 2.6.21-dev, created on 2008-12-11 15:29:37
         compiled from admin/campaign_choices_addedit.tpl */ ?>
<h3>Managing <i><?php echo $this->_tpl_vars['campaign']->getName(); ?>
</i> Voting Choices</h3>
<form id="campaign_choices" action="/admin/Campaigns" method="POST">
	<ul class="choice_holder">
		<?php $this->assign('choiceNum', 0); ?>
		<?php $_from = $this->_tpl_vars['campaign']->getChoices(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['choice']):
?>
			<?php $this->assign('choiceNum', $this->_tpl_vars['choiceNum']+1); ?>
			<li>
				<label for="choice[<?php echo $this->_tpl_vars['choice']->getId(); ?>
][main]">Choice <?php echo $this->_tpl_vars['choiceNum']; ?>
:</label> 
				<input type="text" name="choice[<?php echo $this->_tpl_vars['choice']->getId(); ?>
][main]" value="<?php echo $this->_tpl_vars['choice']->getChoice(); ?>
" />
				<a href="#" onclick="return !choiceDelete(this);"><image src="/images/admin/cancel.png" /></a>
				<ul class="option_holder">
				<?php $_from = $this->_tpl_vars['campaign']->getChoices($this->_tpl_vars['choice']->getId()); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['option']):
?>
					<li class="option">
						<input type="text" name="choice[<?php echo $this->_tpl_vars['choice']->getId(); ?>
][exist][<?php echo $this->_tpl_vars['option']->getId(); ?>
]" value="<?php echo $this->_tpl_vars['option']->getChoice(); ?>
" class="option" />
						<a href="#" onclick="return !optionDelete(this);"><image src="/images/admin/cancel.png" /></a>
					</li>
				<?php endforeach; endif; unset($_from); ?>
					<li>
						<div style="padding-bottom: 10px;"><a href="#" onclick="return !addOption(this);">Add New Option</a></div>
					</li>
				</ul>
			</li>
		<?php endforeach; endif; unset($_from); ?>
		
	</ul>
	<div style="padding-top: 10px;"><a href="#" onclick="return !addChoice(this);">Add New Choice</a></div>
	<input type="hidden" name="section" value="questionedit" />
	<input type="hidden" name="campaign_id" value="<?php echo $this->_tpl_vars['campaign']->getId(); ?>
" />
	<input type="submit" name="choices_submit" value="Update" />
</form>