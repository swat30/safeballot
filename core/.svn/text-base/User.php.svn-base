<?php

/*
 * Use this class only if you want a basic user that will have authentication abilities.
 * 
 * For users that require extended profile information, use the User_Profile class, which extends this class.
 */

include_once 'Auth/Auth.php';
include_once 'Auth/Container.php';

class User extends Auth_Container {

	protected $usr_id;
	protected $username;
	protected $name;
	protected $email;
	protected $status;
	
	protected $auth_group;
	protected $auth_group_name;
	protected $password;
	protected $salt;
	protected $permissions = array();

	public function __construct($usr_id = null) {
		if (!is_null($usr_id)) {
			if (!is_numeric($usr_id)) {
				$sql = 'select aut_id from auth where aut_username="' . e($usr_id) . '"';
				$res = Database::singleton()->query_fetch($sql);
				$usr_id = $res['aut_id'];
			}
			
			$sql = 'SELECT * 
					FROM auth 
					LEFT JOIN auth_groups
					ON auth.aut_agp_id = auth_groups.agp_id
					WHERE auth.aut_id = "'. e($usr_id) .'"';
			$result = Database::singleton()->query_fetch($sql);
			$result = Database::singleton()->unescape($result);
					
			$this->usr_id = $result['aut_id'];
			$this->username = $result['aut_username'];
			$this->name = $result['aut_name'];
			$this->email = $result['aut_email'];
			$this->password = $result['aut_password'];
			$this->salt = $result['aut_salt'];
			$this->auth_group = $result['aut_agp_id'];
			$this->auth_group_name = $result['agp_name'];
			$this->status = $result['aut_status'];
			$this->permissions = $this->getPerms();
		}
		
	}

	public function getPerms() {
		$sql = 'SELECT p.key FROM groups_permissions g, permissions p WHERE g.perm_id=p.id AND g.group_id=' . $this->auth_group;
		$result = @Database::singleton()->query_fetch_all($sql);
		$permissions = array();
		foreach ($result as $perm) {
			$permissions[] = $perm['key'];
		}
		return $permissions;
	}
	
	public function hasPerm($key) {
		return in_array($key, $this->permissions);
	}
	
	public function save() {
		
		$result = false;
		
		$e_sql = "SELECT aut_id FROM auth WHERE aut_id = '". Database::singleton()->escape($this->usr_id) ."'";
		$e_result = Database::singleton()->query_fetch($e_sql);

		if ($e_result) {
			$sql = "UPDATE auth SET 
						aut_username = '". Database::singleton()->escape($this->username) ."',
						aut_password = '". Database::singleton()->escape($this->password) ."',
						aut_salt     = '". Database::singleton()->escape($this->salt) . "',
						aut_agp_id   = '". Database::singleton()->escape($this->auth_group) ."',
						aut_name     = '". Database::singleton()->escape($this->name) ."',						
						aut_email    = '". Database::singleton()->escape($this->email) ."',
						aut_status   = '". Database::singleton()->escape($this->status) ."',					
						aut_last_touched = NOW()
						where aut_id = '". Database::singleton()->escape($this->usr_id) ."'";			
			$result = Database::singleton()->query($sql);
		}
		else {
			$sql = "INSERT INTO auth SET 
						aut_username = '". Database::singleton()->escape($this->username) ."',
						aut_password = '". Database::singleton()->escape($this->password) ."',
						aut_salt     = '". Database::singleton()->escape($this->salt) ."',
						aut_name     = '". Database::singleton()->escape($this->name) ."',						
						aut_email    = '". Database::singleton()->escape($this->email) ."',
						aut_status   = '". Database::singleton()->escape($this->status) ."',				
						aut_last_touched = NOW(),
						aut_agp_id   = '". Database::singleton()->escape($this->auth_group) . "'";

			$result = Database::singleton()->query($sql);
			
			//$e_result = Database::singleton()->query_fetch($e_sql);
			$this->setId(Database::singleton()->lastInsertedID());
		}

		return $result;
	}
	
	public function delete() {
		
		$result = false;
		
		$sql = "UPDATE auth SET aut_status = '0' WHERE aut_id = '". Database::singleton()->escape($this->usr_id) ."'";
		$result = Database::singleton()->query($sql);			
		
		return $result;
	}
	
	public function permDelete() {
		$result = false;
		
		$sql = "delete from auth WHERE aut_id = '". e($this->usr_id) ."'";
		$result = Database::singleton()->query($sql);			
		
		return $result;
	}

	public function getId() {
		return $this->usr_id;
	}
	
	public function getUsername () {
		return $this->username;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getEmail() {
		return $this->email;
	}
	
	public function getActiveStatus() {
		return $this->status;
	}
	
	public function getAuthGroup() {
		return $this->auth_group;
	}
	
	public function getAuthGroupName() {
		return $this->auth_group_name;
	}
	
	public function getPassword() {
		return $this->password;
	}
	
	public function setId ($id) {
		$this->usr_id = $id;
	}
	
	public function setUsername($username) {
		$this->username = $username;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function setEmail($email) {
		$this->email = $email;
	}
	
	public function setPassword($password) {
		$salt = uniqid('norexcms', true);
		$this->salt = $salt;
		$this->password = (md5($password . md5($salt)));
		
	}

	public function setActiveStatus($status) {
		$this->status = $status;
	}
	
	public function setAuthGroup($group) {
		$this->auth_group = $group;	
	}

	public function setAuthGroupName($group_name) {
		$this->auth_group_name = $group_name;
	}
	
	public static function getUsers() {
		$sql = "SELECT * 
				FROM auth 
				LEFT JOIN auth_groups
				ON aut_agp_id = agp_id
				WHERE aut_status > 0
				ORDER BY aut_username";
		$sql_result = Database::singleton()->query_fetch_all($sql);
		$sql_result = Database::singleton()->unescape($sql_result);
		
		$users = array();
		foreach ($sql_result as $user) {
			$users[$user['aut_id']] = new User();
			$users[$user['aut_id']]->setId($user['aut_id']);
			$users[$user['aut_id']]->setUsername($user['aut_username']);
			$users[$user['aut_id']]->setName($user['aut_name']);
			$users[$user['aut_id']]->setEmail($user['aut_email']);
			$users[$user['aut_id']]->setAuthGroup($user['agp_id']);
			$users[$user['aut_id']]->setAuthGroupName($user['agp_name']);
			$users[$user['aut_id']]->setActiveStatus($user['aut_status']);
		}
		
		return $users;
	}	

	public function __toString() {
		return 'User class object';
	}
	
	public function fetchData($username, $password) {
    	$sql = "SELECT * FROM auth WHERE aut_username = '". e($username) ."' AND aut_status = 1";
        $token = Database::singleton()->query_fetch($sql);
        if ((md5($password . md5($token['aut_salt']))) == $token['aut_password']) {
        	$_SESSION['authenticated_user'] = new User($token['aut_id']);        	
        	return true;
        } else {
        	unset($_SESSION['authenticated_user']);
        	return false;
        }
    	
    }
	
	public function isMe($usr_id = null) {
		if (is_null($usr_id)) {
			$usr_id = $this->usr_id;
		}
		if ($usr_id == $_SESSION['authenticated_user']->getId()) {
			return true;
		}
		return false;
	}
    
}

?>
