<?php

class MenuItem {
	
	protected $id;
	public $linkType;
	public $status;
	public $link;
	public $sort;
	public $display;
	public $depth;
	public $parent;
	public $link_id;
	public $target;
	public $module_id;
	public $top = false;
	public $bottom = false;
	public $children;
	
	public function __construct($id = null, $restriction = false) {
		if (!is_null($id)) {
			$this->id = $id;
			
			$sql = 'SELECT menu.*, `modules`.module FROM menu, `modules` where menu.module_id=`modules`.id and menu.id=' . $this->id;
			$item = Database::singleton()->query_fetch( $sql );
			// Create a link using the linkHandler callback.
			$this->link = Module::factory( $item ['module'] )->linkHandler( $item ['link'] );
			$this->display = $item ['display'];
			$this->status = $item ['status'];
			$this->sort = $item ['sort'];
			$this->parent = $item ['parent_id'];
			$this->linkType = Module::factory( $item ['module'] )->linkType();
			$this->target = $item ['target'];
			$this->link_id = $item ['link'];
			$this->module_id = $item ['module_id'];
		}
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getAddEditForm($target = '/admin/Menu') {
		require_once 'Menu.php';
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

}

?>
