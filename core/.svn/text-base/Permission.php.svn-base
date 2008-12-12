<?php

class Permission {
	
	private $id = null;
	private $key = null;
	private $title = null;
	private $desc = null;
	
	public function __construct($id = null) {
		if (!is_null($id)) {
			$this->id = $id;
			
			$sql = 'select * from permissions where id=' . $this->id;
			$p = Database::singleton()->query_fetch($sql);
			$this->key = $p['key'];
			$this->title = $p['title'];
			$this->desc = $p['desc'];
		}
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	public function getKey() {
		return $this->key;
	}
	
	public static function getPermissions() {
		$sql = 'select * from permissions';
		$p = Database::singleton()->query_fetch_all($sql);
		foreach ($p as &$perm) {
			$perm = new Permission($perm['id']);
		}
		return $p;
	}
	
}

?>