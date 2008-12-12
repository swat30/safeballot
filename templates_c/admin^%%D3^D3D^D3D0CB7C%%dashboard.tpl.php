<?php /* Smarty version 2.6.21-dev, created on 2008-08-26 12:02:54
         compiled from dashboard.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'menu', 'dashboard.tpl', 15, false),)), $this); ?>
<div class="dashboard">
<?php echo smarty_function_menu(array('company' => true), $this);?>

</div>