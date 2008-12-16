<?php
/**
 * Site Initialization
 *
 * @author Christopher Troup <chris@norex.ca>
 * @package CMS
 * @subpackage Core
 * @version 2.0
 */

if(($_SERVER['HTTPS'] != 'on' || $_SERVER['HTTP_HOST'] != 'www.safeballot.com') && $_SERVER['SERVER_ADDR'] != '127.0.1.1'){
	header("Location: https://www.safeballot.com".$_SERVER['REQUEST_URI']);
}

/*
 * Kicks things off with initiliziation of the general framework infrastructure.
 */
include_once 'include/Site.php';

error_reporting(E_ALL);

/*
 * Assess whether we are logging in on this page request.
 */
if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
	$auth_container = new CMSAuthContainer();
	$auth = new Auth($auth_container, null, 'authInlineHTML');
	$auth->start();
}


if (@!isset($_REQUEST['module'])) {
	$options = Config::singleton()->options;
	$_REQUEST['module'] = 'Content';
	$_REQUEST['page'] = $options['defaultPage'];
}


require_once 'HTML/AJAX/Helper.php';
$ajaxHelper = new HTML_AJAX_Helper ( );

if ( $ajaxHelper->isAJAX () ){
	echo Module::factory($_REQUEST['module'], $smarty)->getUserInterface($_REQUEST);
} else {
	//$smarty->addJS('/AJAX/server.php?client=all');
	//$smarty->addJS('/js/login.js');
	$smarty->addJS('/js/scriptaculous.js');
	//$smarty->addJS('/js/frontend.js');
	
	$smarty->content[$_REQUEST['module']] = Module::factory($_REQUEST['module'], $smarty)->getUserInterface($_REQUEST);
	$smarty->assign ( 'module', $_REQUEST['module'] );
	if (isset($_SESSION['authenticated_user'])) {
		$smarty->assign ( 'user', $_SESSION['authenticated_user'] );
	}
	$smarty->render ( 'db:site.tpl' );
}

//Config::setModuleOptions('CMS', array('name'=>'Safeballot', 'defaultPage'=>'Home', 'defaultPageTitle'=>'Safeballot'));
?>
