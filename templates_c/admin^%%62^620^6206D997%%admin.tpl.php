<?php /* Smarty version 2.6.21-dev, created on 2008-08-26 12:02:54
         compiled from admin.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'menu', 'admin.tpl', 24, false),array('function', 'module', 'admin.tpl', 32, false),)), $this); ?>
<?php echo '<?xml'; ?>
 version="1.0" encoding="iso-8859-1"<?php echo '?>'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $this->assign('cms', $this->_tpl_vars['config']->getModuleOptions()); ?>
<title><?php echo $this->_tpl_vars['cms']['name']; ?>
 - Website Management</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link rel="stylesheet" href="/css/admin.css,/css/admin_menu.css,/css/admin_tabs.css,/css/tablesorter.css<?php $_from = $this->_tpl_vars['css']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cssUrl']):
?>,<?php echo $this->_tpl_vars['cssUrl']; ?>
<?php endforeach; endif; unset($_from); ?>" type="text/css"/>

<script type="text/javascript" src="/js/prototype.js,/js/scriptaculous.js<?php $_from = $this->_tpl_vars['js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['jsUrl']):
?>,<?php echo $this->_tpl_vars['jsUrl']; ?>
<?php endforeach; endif; unset($_from); ?>"></script>
<script type="text/javascript" src="/core/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>

</head>
<body>

<div id="sitewrap">
	
	<div id="headerHolder">
		<div id="headerTitle"><a href="/admin/"><img src="/images/admin/norex_logo.png" alt="Norex" title="Norex" /></a></div>
		<div id="logout"><a href="/user/logout">LOGOUT</a> | <a href="/" title="Return to Public Site">BACK TO SITE</a></div>
		<div id="nav"><?php echo smarty_function_menu(array('admin' => true), $this);?>
</div>
	</div>

	<div id="content">
		<div id="contentTopTd"></div>
		<div id="contentTd">
			<h2><span style="color:#000;">norex://</span> <?php echo $this->_tpl_vars['module_title']; ?>
</h2>
			<div id="messages"></div>
			<div id="module_content"><?php echo smarty_function_module(array('class' => $this->_tpl_vars['module'],'admin' => true), $this);?>
</div>
		</div>
		<div id="contentBottomTd"></div>
	</div>
	
	<div id="footer">
		<p>&copy; 2007 by <a href="http://www.norex.ca" title="Norex Core Web Development">Norex Core Web Development</a></p>
		<p>Codename Beeblebrox</p>
	</div>

</div>

</body>
</html>