<?php
/**
 * Admin Initialization
 * 
 * @todo fix .htaccess file so that trim() hack isn't required
 * 
 * @author Christopher Troup <chris@norex.ca>
 * @package CMS
 * @subpackage Core
 * @version 2.0
 */

if(($_SERVER['HTTPS'] != 'on' || $_SERVER['HTTP_HOST'] != 'www.safeballot.com') && $_SERVER['SERVER_ADDR'] != '127.0.1.1'){
	header("Location: https://www.safeballot.com".$_SERVER['REQUEST_URI']);
}

header("p3p: CP=\"ALL DSP COR PSAa PSDa OUR NOR ONL UNI COM NAV\"");

/**
 * Require the site initialization file
 */

require_once (dirname(__FILE__) . "/../include/Site.php");
$auth_container = new CMSAuthContainer();
$auth = new CMSAuth($auth_container, null, 'authHTML');
$auth->start();

if ($auth->checkAuth()) {
	// set templates dir to the admin templates location
	$smarty->template_dir = SITE_ROOT . '/cms/templates';
	// set a custom compile id to ensure Smarty doesent accidentally overwrite duplicate compiled files.
	$smarty->compile_id = 'admin';
	
	// This is currently a hack since my url-rewriting syntax keeps a trailing slash on the module name
	$requestedModule = trim(@$_GET['module'], '/');
	
	// assign the requested module
	$smarty->assign('module', $requestedModule);
	
	// render the admin page
	require_once 'HTML/AJAX/Helper.php';
	$ajaxHelper = new HTML_AJAX_Helper ( );
	
	if ( $ajaxHelper->isAJAX () ){
		echo Module::factory($requestedModule, $smarty)->getAdminInterface();
		die();
	} else {
		$smarty->assign ( 'isAdmin', $_SESSION['authenticated_user']->hasPerm('admin'));
		if (!isset($_REQUEST['module'])) {
			$requestedModule = 'Dashboard';
			$smarty->assign ( 'module', $requestedModule );
			$smarty->assign ( 'module_title', 'Dashboard' );
		} else {
			$smarty->content[$requestedModule] = Module::factory($requestedModule, $smarty)->getAdminInterface();
			$smarty->assign ( 'module', $requestedModule );
			
			$sql = 'select display_name from modules where module="' . e($requestedModule) . '"';
			$r = Database::singleton()->query_fetch($sql);
			$smarty->assign ( 'module_title', $r['display_name'] );
		}
		
		
		$smarty->addCSS('/css/facebox.css');
		$smarty->addJS('/js/facebox.js');
		
		$smarty->addJS('/js/help.js');
		
		$smarty->addJS('/js/admin.js');
		$smarty->render('admin.tpl');
	}
}
	
?>