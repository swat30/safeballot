<?php
/**
 * Skeleton Module
 * @author Christopher Troup <chris@norex.ca>
 * @package Modules
 * @version 2.0
 */ 

/**
 * @package Modules
 * @subpackage Menu
 */
class Module_Menu extends Module {
	
	public $version = '$Id: Menu.php 8394 2008-10-20 15:51:03Z chris $';
	
	/**
	 * Build and return admin interface
	 * 
	 * Any module providing an admin interface is required to have this function, which
	 * returns a string containing the (x)html of it's admin interface.
	 * @return string
	 */
	function getAdminInterface() {
		$this->template = 'admin/menu.tpl';
		
		switch ( @$_REQUEST ['section']) {
			case 'menuTable' :
				require_once 'include/Menu.php';
				$menu = new Menu( );
				
				if (@$_REQUEST ['direction'] == 'up') {
					$menu->moveItem( $_REQUEST ['id'], MENU_UP );
				} else if (@$_REQUEST ['direction'] == 'down') {
					$menu->moveItem( $_REQUEST ['id'], MENU_DOWN );
				} else if (@isset( $_REQUEST ['delete'] )) {
					$menu->deleteItem( $_REQUEST ['id'] );
				} else if (@isset( $_REQUEST ['toggleActive'] )) {
					$menu->toggleActive( $_REQUEST ['id'] );
				}
				
				$this->smarty->assign( 'menu', $menu->getRoots() );
				return $this->smarty->fetch( 'admin/menu_table.tpl' );
				break;
			case 'deleteMenuItem' :
				require_once 'include/Menu.php';
				$menu = new Menu( );
				$menu->deleteItem( $_REQUEST ['id'] );
				$this->smarty->assign( 'menu', $menu->getRoots() );
				return $this->smarty->fetch( 'admin/menu_table.tpl' );
				break;
			case 'addedit' :
				
				if (! $form = $this->getAddEditForm())
					break;
				//$renderer = new HTML_QuickForm_Renderer_ArraySmarty( $this->smarty );
				//$form->accept( $renderer );
				
				//$formArray = $renderer->toArray();
				
				$this->smarty->assign( 'form', $form );
				if (! $form->validate())
					$this->template = 'admin/menu_addedit.tpl';
				break;
		}
		return $this->smarty->fetch( $this->template );
	}
	
	public function getAddEditForm($target = '/admin/Menu') {
		require_once 'include/Menu.php';
		if (isset( $_REQUEST ['id'] ))
			$item = new MenuItem( $_REQUEST ['id'] );
		
		$status = array ( 'active' => 'Active', 'disabled' => 'Disabled' );
		$defaultValues ['status'] = @array ( $item->status );
		
		$menu = new Menu( );
		$parent = $menu->toArray();
		$defaultValues ['parent'] = @array ( $item->parent );
		
		$form = new Form( 'menu_addedit', 'POST', $target, '', array ( 'class' => 'admin' ) );
		
		if (@$item) {
			$form->setConstants( array ( 'id' => $item->getId(), 'section' => 'addedit' ) );
			$form->addElement( 'hidden', 'id' );
			$links = $menu->getLinkables( $item->module_id );
		} else {
			$form->setConstants( array ( 'section' => 'addedit' ) );
		}
		$form->addElement( 'hidden', 'section' );
		
		$form->addElement( 'text', 'display', 'Display Name', array ( 'value' => @$item->display ) );
		
		$active = Config::getActiveModules();
		$linkableType = array ( );
		foreach ( $active as $module ) {
			$modulename = 'Module_' . $module ['module'];
			include_once SITE_ROOT . '/modules/' . $module ['module'] . '/' . $module ['module'] . '.php';
			$obj = new $modulename( );
			$test = new ReflectionClass( $modulename );
			
			if ($test->hasMethod( 'getValidLinks' )) {
				$linkableType [$module ['id']] = $obj->linkType();
			}
		}
		if (@!$item) {
			$keys = (array_keys( $linkableType ));
			$links = $menu->getLinkables( $keys [0] );
		}
		
		$defaultValues ['link'] = @array ( $item->link_id );
		$defaultValues ['linktype'] = @array ( $item->module_id );
		$defaultValues ['target'] = @array ( $item->target );
		
		$form->addElement( 'select', 'status', 'Status', $status );
		$form->addElement( 'select', 'linktype', 'Link Type', $linkableType );
		$form->addElement( 'select', 'link', 'Link To', $links );
		$form->addElement( 'select', 'target', 'Open In', array ( 'same' => 'Same Window', 'new' => 'New Window' ) );
		$form->addElement( 'select', 'parent', 'Parent Item', $parent );
		
		$form->addElement( 'submit', 'submit', 'Save' );
		
		$form->applyFilter( 'display', 'trim' );
		$form->addRule( 'display', 'Please enter a display name', 'required', null, 'client' );
		$form->addRule( 'parent', 'Please choose a parent', 'required', null, 'client' );
		$form->addRule( 'linktype', 'Please choose a link type', 'required', null, 'client' );
		$form->addRule( 'link', 'Please choose a link page', 'required', null, 'client' );
		$form->addRule( 'target', 'Please choose a target', 'required', null, 'client' );
		$form->addRule( 'status', 'Please choose a status', 'required', null, 'client' );
		
		$form->setDefaults( $defaultValues );
		
		if (isset( $_REQUEST ['submit'] ) && $form->validate()) {
			$this->template = 'admin/menu.tpl';
			
			$this->doMenuSubmit();
			return false;
		} else {
			if (isset( $_REQUEST ['submit'] )) {
				$formArray ['errors'] = $form->_errors;
			}
		}
		
		return $form;
	}
	
	public function doMenuSubmit() {
		if (@isset( $_REQUEST ['id'] )) {
			$sql = 'update menu set display="' . $_REQUEST ['display'] . '", parent_id=' . $_REQUEST ['parent'] . ', status="' . $_REQUEST ['status'] . '", link="' . $_REQUEST ['link'] . '", module_id="' . $_REQUEST ['linktype'] . '", target="' . $_REQUEST ['target'] . '" WHERE id=' . $_REQUEST ['id'];
		} else {
			$sql = 'select max(sort) as sort from menu where parent_id=' . $_REQUEST ['parent'];
			$result = Database::singleton()->query_fetch( $sql );
			$sql = 'insert into menu set display="' . $_REQUEST ['display'] . '", parent_id=' . $_REQUEST ['parent'] . ', status="' . $_REQUEST ['status'] . '", sort=' . ($result ['sort'] + 1) . ', link="' . $_REQUEST ['link'] . '", module_id="' . $_REQUEST ['linktype'] . '", target="' . $_REQUEST ['target'] . '"';
		}
		Database::singleton()->query( $sql );
		$this->insertMenu();
	}
	
	public static function insertMenu() {
		global $smarty;
		require_once 'include/Menu.php';

		$menu = new Menu( true, true );
		$smarty->assign( 'menu', $menu->getRoots(  ) );
		$oldtempdir = $smarty->template_dir;
		$smarty->template_dir = dirname(__FILE__) . '/templates';
		$smarty->compile_id = 'Module_Menu';
		$menuMarkup = $smarty->fetch( 'db:menu_rendertop.tpl' );
		$sql = 'truncate table menu_loaded';
		Database::singleton()->query($sql);
		$sql = 'insert into menu_loaded set menu="'.e($menuMarkup).'"';
		Database::singleton()->query($sql);
		$smarty->template_dir = $oldtempdir;
		$smarty->compile_id = 'CMS';
	}
	
	public function getUserInterface($params = null) {
		//if(!$_SESSION['authenticated_user']){
		//	$sql = 'select menu from menu_loaded order by id desc limit 1';
		//	$menu = Database::singleton()->query_fetch($sql);
		//	return $menu['menu'];
		//} else {
			require_once 'include/Menu.php';
			$menu = new Menu( true );
			$this->smarty->assign( 'menu', $menu->getRoots() );
			return $this->smarty->fetch( 'db:menu_rendertop.tpl' );
		//}
	}
}

?>