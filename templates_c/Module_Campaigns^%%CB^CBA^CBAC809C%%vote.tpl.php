<?php /* Smarty version 2.6.21-dev, created on 2008-12-11 16:06:45
         compiled from vote.tpl */ ?>
<h1>Voting on <i><?php echo $this->_tpl_vars['campaign']->getName(); ?>
</i></h1>
<p><?php echo $this->_tpl_vars['campaign']->getDescription(); ?>
</p>
<?php echo $this->_tpl_vars['form']->display(); ?>