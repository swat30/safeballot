<?php
/**
 * AJAX Initialization
 * 
 * @author Christopher Troup <chris@norex.ca>
 * @package CMS
 * @subpackage Core
 * @version 2.0
 */

/**
 * Require the Site initialization file.
 */
require dirname(__FILE__) . '/../include/Site.php';

/**
 * Require the AJAX Server class
 */
require 'HTML/AJAX/Server.php';

//Create server instance
$server = new HTML_AJAX_Server();
$server->ajax->packJavaScript = true;

include_once dirname(__FILE__) . '/../modules/Menu/include/Menu.php';
$menu = new Menu();
$server->registerClass($menu, 'Menu', array('getLinkables'));

//Handle the request based on $_GET variables
$server->handleRequest();
?>
