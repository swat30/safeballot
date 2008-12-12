<?php
/**
 * Content Module AJAX
 * @author Christopher Troup <chris@norex.ca>
 * @package Modules
 * @subpackage Content
 * @version 2.0
 */

require dirname( __FILE__ ) . '/../../include/Site.php';
require_once 'Pager/Pager.php';

$module = Module::factory( 'Content' );

switch ( $_REQUEST ['section']) {
	case 'inactive' :
		switch ( @$_REQUEST ['action']) {
			case 'deleteRev' :
				$module->deleteRev( $_REQUEST ['id'] );
				break;
			case 'setActiveRev' :
				$module->setActiveRev( $_REQUEST ['id'] );
				break;
		}
		
		$rows = Database::singleton()->query_fetch_all( 'select content_page_data.*, locale.display_name as locale from content_page_data, locale
			WHERE parent_id=' . $_REQUEST ['parent_id'] . ' AND locale.id=content_page_data.locale_id and content_page_data.status=0 order by timestamp desc' );
		
		$pager_params = array ( 'mode' => 'Sliding', 'append' => false, //don't append the GET parameters to the url
'path' => '', 'fileName' => 'javascript:HTML_AJAX.replace(\'inactive\',\'/modules/Content/AJAX_layers.php?section=inactive&parent_id=' . $_REQUEST ['parent_id'] . '&pageID=%d\');', //Pager replaces "%d" with the page number...
'perPage' => 5, //show 10 items per page
'delta' => 5, 'itemData' => $rows );
		
		$pager = & Pager::factory( $pager_params );
		$data = $pager->getPageData();
		
		$module->smarty->assign( 'layers', $data );
		$module->smarty->assign( 'pager_links', $pager->links );
		$module->smarty->assign( 'parent_id', $_REQUEST ['parent_id'] );
		$module->smarty->assign( 'page_numbers', array ( 'current' => $pager->getCurrentPageID(), 'total' => $pager->numPages() ) );
		
		echo $module->smarty->fetch( 'admin/content_ajaxlayers.tpl' );
		break;
	case 'active' :
		switch ( @$_REQUEST ['action']) {
			case 'deleteRev' :
				$module->deleteRev( $_REQUEST ['id'] );
				break;
			case 'toggleStatus' :
				$module->toggleStatus( $_REQUEST ['id'] );
				break;
		}
		
		$published = Database::singleton()->query_fetch_all( 'select content_page_data.*, locale.display_name as 
			locale from content_page_data, locale WHERE parent_id=' . $_REQUEST ['parent_id'] . ' AND locale.id=content_page_data.locale_id 
			and content_page_data.status=1 order by timestamp desc' );
		
		$module->smarty->assign( 'published', $published );
		$module->smarty->assign( 'parent_id', $_REQUEST ['parent_id'] );
		
		echo $module->smarty->fetch( 'admin/content_publishedlayers.tpl' );
		break;
}

?>
