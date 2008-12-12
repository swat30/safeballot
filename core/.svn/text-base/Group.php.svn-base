<?php

class Group {
	
	private $id = null;
	private $name = null;
	private $permissions = null;
	private $status = null;
	private $members = null;
	
	public function __construct($id = null) {
		if (!is_null($id)) {
			$sql = 'select * from auth_groups where agp_id=' . $id;
			if (!$gp = Database::singleton()->query_fetch($sql)) {
				return;
			}
			$this->id = $id;
			$this->name = $gp['agp_name'];
			$this->status = $gp['agp_status'];
			
			$this->doPermissions();
		}
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getStatus() {
		return $this->status;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function setStatus($status) {
		$this->status = $status;
	}
	
	public function save() {
		if (!is_null($this->id)) {
			$sql = 'update auth_groups set agp_name="' . e($this->name) . '", agp_status="'.e($this->status).'" where agp_id=' . e($this->id);
		} else {
			$sql = 'insert into auth_groups set agp_name="' . e($this->name) . '", agp_status="'.e($this->status).'"';
		}
		Database::singleton()->query($sql); 
		
		if (is_null($this->id)) {
			$this->id = Database::singleton()->lastInsertedID();
			self::__construct($this->id);
		}
 	}
	
	public function delete() {
		$sql = 'delete from auth_groups where agp_id=' . e($this->id);
		Database::singleton()->query($sql);
	}
	
	public function getMembers() {
		if (is_null($this->members)) {
			$sql = 'select aut_id from auth where aut_agp_id=' . $this->id;
			$members = Database::singleton()->query_fetch_all($sql);
			foreach ($members as &$member) {
				$member = new User($member['aut_id']);
			}
			$this->members = $members;
		}
		return $this->members;
	}
	
	public function hasPerm($key) {
		foreach ($this->permissions as $perm) {
			if (!is_numeric($key)) { 
				if ($perm->getKey() == $key) {
					return true;
				}
			} else {
				if ($perm->getId() == $key) {
					return true;
				}
			}
		}
		return false;
	}
	
	public function togglePerm($perm) {
		if ($this->hasPerm($perm)) {
			$sql = 'delete from groups_permissions where group_id=' . $this->id . ' and perm_id=' . $perm;
		} else {
			$sql = 'insert into groups_permissions set group_id=' . $this->id . ', perm_id=' . $perm;
		}
		Database::singleton()->query($sql);
		$this->doPermissions();
	}
	
	public function doPermissions() {
		$sql = 'select * from groups_permissions where group_id=' . $this->id;
		$p = Database::singleton()->query_fetch_all($sql);
		foreach ($p as &$perm) {
			$perm = new Permission($perm['perm_id']);
		}
		$this->permissions = $p;
	}
	
	public static function getAddEditForm($target = '/admin/User') {
		$form = new Form( 'group_addedit', 'POST', $target, '',
		array ( 'class' => 'admin' ) );
		
		if (@$_REQUEST ['id']) {
			$group = new Group($_REQUEST['id']);
			$form->setConstants( array ( 'id' => $_REQUEST ['id'] ) );
			$form->addElement( 'hidden', 'id' );
		}
		else {
			$group = new Group();
		}
		
		$form->setConstants( array ( 'section' => 'groupsaddedit' ) );
		$form->addElement( 'hidden', 'section' );
		
		$form->addElement( 'text', 'name', 'Group Name' );
		$form->addElement( 'submit', 'submit', 'Save' );
		$form->addElement( 'reset', 'cancel', 'Cancel' );
		
		$defaultValues ['name'] = $group->getName();
		$form->setDefaults( $defaultValues );
		
		if ($form->validate() && isset($_REQUEST['submit'])) {
			$group->setName($_REQUEST['name']);
			$group->save();
		}
		
		return $form;
	}
	
	public static function getGroups() {
		$sql = 'select * from auth_groups';
		$groups = Database::singleton()->query_fetch_all($sql);
		foreach ($groups as &$group) {
			$group = new Group($group['agp_id']);
		}
		return $groups;
	}
	
}

?>