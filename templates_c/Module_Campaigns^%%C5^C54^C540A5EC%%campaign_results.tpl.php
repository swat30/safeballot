<?php /* Smarty version 2.6.21-dev, created on 2008-12-12 09:37:39
         compiled from admin/campaign_results.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'admin/campaign_results.tpl', 9, false),)), $this); ?>
<h3>Viewing <i><?php echo $this->_tpl_vars['campaign']->getName(); ?>
</i> results (<a href="/admin/Campaigns" title="Back">Back</a>)</h3>

<ul id="resultsList">
<?php $_from = $this->_tpl_vars['campaign']->sortVotes(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['choice']):
?>
	<li class="choiceResult"><?php echo $this->_tpl_vars['choice']->getChoice(); ?>
</li>
	<li>
		<ul id="resultsSubList">
		<?php $_from = $this->_tpl_vars['campaign']->sortVotes($this->_tpl_vars['choice']->getId()); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['option']):
?>
			<li class="optionResult"><?php echo $this->_tpl_vars['option']->getChoice(); ?>
: <?php echo smarty_function_math(array('equation' => "(x / y)*100",'x' => $this->_tpl_vars['option']->getVotes(),'y' => $this->_tpl_vars['campaign']->getVoteCount()), $this);?>
%</li>
		<?php endforeach; endif; unset($_from); ?>
		</ul>
	</li>
	<br />
<?php endforeach; endif; unset($_from); ?>
</ul>