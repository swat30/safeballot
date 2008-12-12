<?php

require_once 'MenuItem.php';

define( 'MENU_ROOT_PARENT_ID', 0 );
define( 'MENU_UP', 'up' );
define( 'MENU_DOWN', 'down' );

class Menu {
	
	private $roots = array ( );
	
	public function __construct($onlyactive = false, $pubOnly = false) {
		$this->getChildren( MENU_ROOT_PARENT_ID, $this->roots, 0, $onlyactive, $pubOnly );
	}
	
	private function getChildren($id,&$root,$depth = 0,$onlyactive = false, $pubOnly = false) {
		if ($onlyactive) {
			$where = ' AND status="active" ';
		}
		$sql = 'select * from menu where parent_id=' . $id . @$where . ' ORDER BY sort asc';
		$roots = Database::singleton()->query_fetch_all( $sql );
		$first = true;
		foreach ( $roots as &$item ) {
			if($this->getModInfo($item['module_id']) == 'Content' && $pubOnly == true) {
				include_once('../modules/Content/include/CMSPage.php');
				$data = new CMSPage($item['link']);
				
				if($data->getAccess() == 'public'){
					$cur = & $root [];
					$cur = new MenuItem( $item ['id'] );
					$cur->depth = $depth;
					$this->getChildren( $item ['id'], $cur->children, $depth + 1, $onlyactive, $pubOnly );
					if ($first) {
						$cur->top = true;
						$first = false;
					}
				}
			} else {
				$cur = & $root [];
				$cur = new MenuItem( $item ['id'] );
				$cur->depth = $depth;
				$this->getChildren( $item ['id'], $cur->children, $depth + 1, $onlyactive, $pubOnly );
				if ($first) {
					$cur->top = true;
					$first = false;
				}
			}
		}
		$cur->bottom = true;
	}
	
	public function getRoots() {
		return $this->roots;
	}
	
	public function moveItem($id,$direction) {
		$item = & $this->findMenuItem( $id );
		
		if ($direction == MENU_UP) {
			$item->sort --;
		} else if ($direction = MENU_DOWN) {
			$item->sort ++;
		}
		
		$sql = 'select id from menu where parent_id=' . $item->parent . ' and sort=' . $item->sort;
		$result = Database::singleton()->query_fetch( $sql );
		$reflowitem = & $this->findMenuItem( $result ['id'] );
		
		if ($direction == MENU_UP) {
			$reflowitem->sort ++;
			Database::singleton()->query( 'update menu set sort=sort-1 where id=' . $id );
			Database::singleton()->query( 'update menu set sort=sort+1 where id=' . $result ['id'] );
		} else if ($direction = MENU_DOWN) {
			$reflowitem->sort --;
			Database::singleton()->query( 'update menu set sort=sort+1 where id=' . $id );
			Database::singleton()->query( 'update menu set sort=sort-1 where id=' . $result ['id'] );
		}
		$this->roots = array ( );
		$this->__construct();
	}
	
	public function deleteItem($id) {
		$sql = 'delete from menu where id=' . $id . ' OR parent_id=' . $id;
		Database::singleton()->query( $sql );
		$this->roots = array ( );
		$this->__construct();
	}
	
	public function toggleActive($id) {
		$item = & $this->findMenuItem( $id );
		if ($item->status == 'active') {
			Database::singleton()->query( 'update menu set status="disabled" where id=' . $id );
		} else {
			Database::singleton()->query( 'update menu set status="active" where id=' . $id );
		}
		$this->roots = array ( );
		$this->__construct();
	}
	
	public function getModInfo($id){
		$sql = 'select module from modules where id = "'.$id.'"';
		$result = Database::singleton()->query_fetch($sql);
		return $result['module'];
	}
	
	public function &findMenuItem($id,&$roots = null) {
		if (is_null( $roots ))
			$roots = $this->roots;
		foreach ( $roots as $root ) {
			if ($root->getId() == $id) {
				return $root;
			} else {
				if (! is_null( $root->children )) {
					$item = $this->findMenuItem( $id, $root->children );
				}
			}
		}
		return $item;
	}
	
	public function &toArray($roots = null,&$menu = array('0' => '[ Top Level Item ]'),$depth = 0) {
		if (is_null( $roots ))
			$roots = $this->roots;
		foreach ( $roots as $root ) {
			$menu [$root->getId()] = str_repeat( '--', $depth ) . $root->display;
			if (! is_null( $root->children )) {
				$this->toArray( $root->children, $menu, $depth + 1 );
			}
		}
		return $menu;
	}
	
	public static function getLinkables($module) {
		$sql = 'select module from modules where id=' . $module;
		$moduleName = Database::singleton()->query_fetch( $sql );
		
		$module = Module::factory( $moduleName ['module'] );
		$result = $module->getValidLinks();
		$returnLinks = array ( );
		foreach ( $result as $link ) {
			$returnLinks [$link ['key']] = $link ['value'];
		}
		return $returnLinks;
	}
}

?>
