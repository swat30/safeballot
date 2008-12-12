<?php /* Smarty version 2.6.21-dev, created on 2008-08-26 12:08:50
         compiled from db:site.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'module', 'db:site.tpl', 26, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="<?php echo $this->_tpl_vars['metaKeywords']; ?>
" />
<meta name="description" content="<?php echo $this->_tpl_vars['metaDescription']; ?>
" />
<meta name="title" content="<?php echo $this->_tpl_vars['metaTitle']; ?>
" />
<title>Safe Ballot | The Intelligent Solution to Online Voting Systems</title>
<link rel="stylesheet" href="/css/style.css,/css/cssMenus.css<?php $_from = $this->_tpl_vars['css']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cssUrl']):
?>,<?php echo $this->_tpl_vars['cssUrl']; ?>
<?php endforeach; endif; unset($_from); ?>" type="text/css" />
<script type="text/javascript" src="/js/prototype.js<?php $_from = $this->_tpl_vars['js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['jsUrl']):
?>,<?php echo $this->_tpl_vars['jsUrl']; ?>
<?php endforeach; endif; unset($_from); ?>"></script>

</head>

<body>
<center>
	<!--Begin Container-->
	<div id="container">
		<!--Begin Header-->

		<div id="header">
			<div id="logo">
				&nbsp;
			</div>
			<!--Begin Nav-->
			<div id="navSpacer">&nbsp;</div>
			<?php echo smarty_function_module(array('class' => 'Menu'), $this);?>

		</div>
		<div id="banner">
			<h1 class="bannerText">The <b>easy</b> and <b>intelligent</b> way to create user-friendly, informative surveys for an <b>unlimited</b> number of applications!</h1>

			<a href="/Vote/register"><img src="/images/joinBtn.png" border="0" alt="Join Now!" /></a>
		</div>
		<div id="mainContent">
			<div id="leftCol">
				<?php echo smarty_function_module(array('class' => $this->_tpl_vars['module']), $this);?>

			</div>
			<div id="rightCol">
				<?php if ($this->_tpl_vars['module'] != 'Campaigns'): ?>
					<?php echo smarty_function_module(array('class' => 'Campaigns'), $this);?>

				<?php endif; ?>
				<?php echo smarty_function_module(array('class' => 'Blocks'), $this);?>

			</div>
		</div>
		<div id="footer">
			<div class="copyright">
				Copyright © 2008 Safe Ballot
			</div>

			<div class="norexlink">
				<a href="http://www.norex.ca" target="_blank">Site by Norex</a>
			</div>
		</div>
	</div>
</center>
</body>
</html>




