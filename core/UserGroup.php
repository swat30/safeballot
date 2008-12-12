<?php

class UserGroup {

	private $id;
	private $name;
	private $desc;
	private $type;
	private $group_pic_id;
	private $group_pic;
	private $creator;
	private $creator_username;
	private $created;
	private $last_saved;
	private $privacy;

	/*
	 * Getters/Setters
	 */
	
	public function __construct($grp_id = null) {

		if ($grp_id != null) {
			$sql = "SELECT user_groups.*, auth.aut_username FROM user_groups 
					LEFT JOIN auth
					ON aut_id = grp_usr_id
					WHERE grp_id = '".$grp_id."'";
			if ($result = Database::singleton()->query_fetch($sql)) {
				$result = Database::singleton()->unescape($result);
				$this->id = $result['grp_id'];
				$this->name = $result['name'];
				$this->desc = $result['desc'];
				$this->type = $result['type'];
				$this->group_pic_id = $result['group_pic_id'];
				$this->creator = $result['grp_usr_id'];
				$this->creator_username = $result['aut_username'];
				$this->created = $result['created'];
				$this->last_saved = $result['last_saved'];
				$this->privacy = $result['privacy'];
			}
			else {
				$this->id = null;
				$this->name = null;
				$this->desc = null;
				$this->type = null;
				$this->creator = null;
				$this->creator_username = null;
				$this->created = null;
				$this->last_saved = null;
				$this->privacy = null;
				$this->group_pic_id = null;
			}
		}
	}

	public function getId() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}

	public function getDescription() {
		return $this->desc;
	}

	public function getType() {
		return $this->type;
	}
	
	public function getGroupPic() {
		return $this->group_pic_id;
	}

	public function getCreator() {
		return $this->creator;
	}
	
	public function getCreatorUser() {
		return new User($this->getCreator());
	}
	
	public function getCreatorUsername() {
		return $this->creator_username;
	}
	
	public function getCreated() {
		return $this->created;
	}

	public function getLastSaved() {
		return $this->last_saved;
	}
	
	public function getPrivacyType() {
		return $this->privacy;
	}
	
	public function getMembersCount() {
		$sql = 'select count(mem_usr_id) as count from user_groups_membership where mem_grp_id=' . $this->id . ' group by mem_grp_id';
		$result = Database::singleton()->query_fetch($sql);
		return $result['count'];
	}
	
	public function setId($new_id, $fetch = false) {
		$this->id = $new_id;

		if ($fetch == true) {
			$this->__construct($this->id);
		}
	}

	public function setName($new_name) {
		$this->name = $new_name;
	}
	
	public function setDescription ($new_desc) {
		$this->desc = $new_desc;
	}

	public function setType ($new_type) {
		$this->type = $new_type;
	}
	
	public function setPrivacyType($new_privacy) {
		$this->privacy = $new_privacy;
	}
	
	public function setCreator($new_creator) {
		$this->creator = $new_creator;
		
		$sql = "SELECT aut_username FROM auth WHERE aut_id = '". e($new_creator) ."'";
		$result = Database::singleton()->query_fetch($sql);
		$this->creator_username = $result['aut_username'];
	}
	
	public function setGroupPic (&$file) {
		
		if ($file->isUploadedFile()) {
			$image = new Image();
			$imageID = $image->insert($file->getValue());
			$this->group_pic_id = $imageID;
			$file->moveUploadedFile('/tmp/');
		}
	}

	/*
	 * Management methods
	 */
	
	public function save() {

		$exists_sql = "SELECT grp_id FROM user_groups WHERE grp_id = '".$this->id."'";
		$result = Database::singleton()->query_fetch($exists_sql);

		if ($result) {

			$save_sql = "UPDATE user_groups SET
					name      = '".e($this->name)."',
					`desc`    = '".e($this->desc)."',
					type      = '".e($this->type)."',
					creator   = '".e($this->creator)."',
					privacy   = '".e($this->privacy)."',
					group_pic_id = '".e($this->group_pic_id)."',
					last_saved = NOW()
					WHERE grp_id = '".e($this->id)."'
					";
		}
		else {
			$save_sql = "INSERT INTO user_groups SET
					name       = '".e($this->name)."',
					`desc`     = '".e($this->desc)."',
					type       = '".e($this->type)."',
					grp_usr_id = '".e($this->creator)."',
					privacy    = '".e($this->privacy)."',
					group_pic_id = '".e($this->group_pic_id)."',
					created    = NOW(),
					last_saved = NOW()
					";
		
			$new_record = true;
		}
		$save_result = Database::singleton()->query($save_sql);

		if ($save_result && $new_record) {
			$this->id = Database::singleton()->lastInsertedID();
		}
		
		return $save_result;

	}

	public function delete() {

		$result = false;
		
		$delete_members_sql = "DELETE FROM user_groups_members WHERE grp_id = '"
								.Database::singleton()->escape($this->id)."'";
		
		$delete_member_result = Database::singleton()->query($delete_members_sql);						
								
		$delete_sql = "DELETE FROM user_groups WHERE grp_id = '"
						.Database::singleton()->escape($this->id)."'";

		$delete_result = Database::singleton()->query($delete_sql);

		if ($delete_result == true && $delete_members_sql == true) {
			$this->id = null;
			$this->name = null;
			$this->desc = null;
			$this->type = null;
			
			$result = true;
		}

		return $result;
	}

	public function inGroup($usr_id = null) {
		
		// @todo fix this stub
		if (is_null($usr_id)) {
			$usr_id = $_SESSION['authenticated_user']->getId();
		}
		
		$sql = 'SELECT * 
				FROM   user_groups_membership 
				WHERE  mem_usr_id = "'. e($usr_id) .  '" 
				AND    mem_grp_id=  "'. e($this->id). '"';
		$res = Database::singleton()->query_fetch($sql);
		
		if (!is_null($res)) {
			return true;
		}
		
		return false;
	}
	
	public function joinGroup($usr_id, $is_admin = false) {
		
		$sql = 'INSERT INTO user_groups_membership SET 
		 		mem_usr_id = "' . e($usr_id)   . '", 
		 		mem_grp_id = "' . e($this->id) . '",
		 		mem_admin  = "' . e($is_admin) . '"';
		
		Database::singleton()->query($sql);
	}
	
	public function leaveGroup($usr_id) {
		$sql = 'DELETE FROM user_groups_membership
				WHERE mem_usr_id = "' . e($usr_id) .  '" 
				AND   mem_grp_id=  "' . e($this->id). '"';
		Database::singleton()->query($sql);
	}
	
	public static function getUserGroups($type = '') {

		$sql = "SELECT user_groups.*, auth.aut_username 
				FROM user_groups
				LEFT JOIN auth
				ON aut_id = grp_usr_id";
		if ($type != '') {
			$sql .= " WHERE type = '".$type."'";
		}
		$sql .= " ORDER BY grp_id";

		$sql_result = Database::singleton()->query_fetch_all($sql);
		$sql_result = Database::singleton()->unescape($sql_result);

		$groups = array();
		foreach ($sql_result as $group) {
			$groups[$group['grp_id']] = new UserGroup();
			$groups[$group['grp_id']]->setId($group['grp_id']);
			$groups[$group['grp_id']]->setName($group['name']);
			$groups[$group['grp_id']]->setDescription($group['desc']);
			$groups[$group['grp_id']]->setType($group['type']);
			$groups[$group['grp_id']]->group_pic_id = $group['group_pic_id'];
			$groups[$group['grp_id']]->creator = $group['grp_usr_id'];
			$groups[$group['grp_id']]->creator_username = $group['aut_username'];
			$groups[$group['grp_id']]->created = $group['created'];
			$groups[$group['grp_id']]->privacy = $group['privacy'];	
		}
			
		return $groups;
	}
	
	public static function searchUserGroups($term) {
		$sql = 'select *, ( (1.3 * (MATCH(`name`) AGAINST ("%' . $term . '%" IN BOOLEAN MODE))) + (0.6 * (MATCH(`desc`) AGAINST ("%' . $term . '%" IN BOOLEAN MODE))) ) AS relevance from user_groups where MATCH(`name`,`desc`) AGAINST ("%' . $term . '%" IN BOOLEAN MODE) HAVING relevance > 0 ORDER BY relevance DESC;';
		$groups = Database::singleton()->query_fetch_all($sql);
		foreach ($groups as &$group) {
			$group = new UserGroup($group['grp_id']);
		}
		return $groups;
	}
	
	public function getGroupMembers() {
		
		$sql = 'SELECT mem_usr_id 
				FROM   user_groups_membership 
				WHERE  mem_grp_id= "' . e($this->id) . '"';
		
		$members = Database::singleton()->query_fetch_all($sql);
		
		foreach ($members as &$member) {
			$member = new User_Profile($member['mem_usr_id']);
			$member->getProfile();
		}
		return $members;
	}

}

?>