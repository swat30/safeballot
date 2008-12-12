<?php
/**
 * User_Profile Class
 * @author Christopher Troup <chris@norex.ca>
 * @package Modules
 * @version 2.0
 */

/**
 * User_Profile Object
 *
 * Provide user management for the core CMS
 * @package Modules
 * @subpackage User
 */
class User_Profile extends User {

	//Uses $usr_id from parent;

	private $sex;
	private $birthday;
	private $profile_picture;
	private $biography;
	private $interests;
	private $work;
	private $education;
	private $school;
	private $looking_for;
	private $address;
	private $lastTouched;

	private $friends;
	private $groups;

	private $privSettings = null;

	public function __construct($usr_id = null) {
		parent::__construct($usr_id);
		if (!is_null($usr_id)) {
			$sql = "SELECT * FROM user WHERE usr_id = '". $this->usr_id ."'";
			if (!$user_details = Database::singleton()->query_fetch($sql)) {
				return false;
			}

			$this->sex = $user_details['usr_sex'];
			$this->birthday = $user_details['usr_birthday'];
			$this->profile_picture = $user_details['usr_profile_picture'];
			$this->biography = $user_details['usr_biography'];
			$this->interests = $user_details['usr_interests'];
			$this->work = $user_details['usr_work'];
			$this->education = $user_details['usr_education'];
			$this->school = $user_details['usr_school'];
			$this->looking_for = $user_details['usr_looking_for'];
			$this->lastTouched = $user_details['usr_last_touched'];
			$this->address = new Address($user_details['adr_id']);

			$touch_sql = 'UPDATE user SET usr_last_touched = NOW() WHERE usr_id = "'. e($this->usr_id).'"';
			Database::singleton()->query($touch_sql);
		
		}

	}

	/* Start Basic Setters */

	public function setSex($sex) {
		$this->sex = $sex;
	}

	public function setBirthday($birthday) {
		$this->birthday = $birthday['Y'] . '-' . sprintf("%02s", $birthday['M']) . '-' . sprintf("%02s", $birthday['d']);
	}

	public function setProfilePic(&$file) {
		if ($file->isUploadedFile()) {
			$image = new Image();
			$imageID = $image->insert($file->getValue());
			$this->profile_picture = $imageID;
			$file->moveUploadedFile('/tmp/');
		}
	}

	public function setBiography($bio) {
		$this->biography = $bio;
	}

	public function setInterests($interests) {
		$this->interests = $interests;
	}

	public function setWork($work) {
		$this->work = $work;
	}

	public function setEducation($edu) {
		$this->education = $edu;
	}

	public function setSchool($school) {
		$this->school = $school;
	}

	public function setLookingFor($lookingfor) {
		$this->looking_for = $lookingfor;
	}

	/* End Basic Setters */

	/* Start Basic Getters */

	public function getAddress() {
		return $this->address;
	}

	public function getSex() {
		return $this->sex;
	}

	public function getBirthday() {
		return $this->birthday;
	}

	public function getProfilePic() {
		//this will be useless until it can turn the db entry into a picture, have to get Chris to do this
		return $this->profile_picture;
	}

	public function getBiography() {
		return $this->biography;
	}

	public function getInterests() {
		return $this->interests;
	}

	public function getWork() {
		return $this->work;
	}

	public function getEducation() {
		return $this->education;
	}

	public function getSchool() {
		return $this->school;
	}

	public function getLookingFor() {
		return $this->looking_for;
	}
	
	public function getLastTouched() {
		return $this->lastTouched;
	}

	/* End Basic Getters */

	//This essentially returns the database entry as an array. Prefer to avoid the direct access.
	//Though it's not that big a deal in the short term, in the long term we may need to modify
	//table names or types, etc. Plus I'm pedantic like that. :)
	public function getProfile() {
		if (@is_null($this->profile)) {
			$sql = 'select * from user where usr_id = "' . $this->usr_id . '" order by usr_last_touched desc limit 1';
			$this->profile = Database::singleton()->query_fetch($sql);
		}
	}

	/*
	 * Returns array of User_Pofile objects of all the friends of the current user.
	 */
	public function getFriends() {
		if (is_null($this->friends)) {
			$sql = 'select f.fri_usr_id from user_friends f WHERE (f.own_usr_id="' . e($this->usr_id) . '")';
			$result = Database::singleton()->query_fetch_all($sql);
			foreach ($result as &$friend) {
				$this->friends[$friend['fri_usr_id']] = new User_Profile($friend['fri_usr_id']);
			}
		}
		return $this->friends;
	}

	/*
	 * Returns an array of UserGroup objects of all the groups the current user belongs to.
	 */
	public function getGroups() {

		if (is_null($this->groups)) {
			$sql = "SELECT user_groups.*
					FROM user_groups_membership, user_groups
					WHERE mem_grp_id = grp_id and mem_usr_id = '". $this->usr_id ."'";
			$result = Database::singleton()->query_fetch_all($sql);

			foreach ($result as &$group) {
				$this->groups[$group['grp_id']] = new UserGroup($group['grp_id']);
			}
		}

		return $this->groups;
	}

	/*
	 * @todo refactor this later, not currently urgent
	 */
	public function getPrivacy($setting) {
		if ($this->isMe($this->usr_id)) {
			return true;
		}

		
		if ($this->isFriend($_SESSION['authenticated_user']->getId())) {
			$sql = 'SELECT prm_set FROM user_permissions WHERE prm_scope ="friends" AND prm_set="' . $setting . '" and prm_usr_id = "' . $this->usr_id . '"';
			$perms = Database::singleton()->query_fetch($sql);
			if (!is_null($perms)) {
				return true;
			}
		}

		if ($this->isInSameGroup($_SESSION['authenticated_user']->getId())) {
			$sql = 'SELECT prm_set FROM user_permissions WHERE prm_scope ="groups" AND prm_set="' . $setting . '" and prm_usr_id = "' . $this->usr_id . '"';
			$perms = Database::singleton()->query_fetch($sql);
			if (!is_null($perms)) {
				return true;
			}
		}

		$sql = 'SELECT prm_set FROM user_permissions WHERE prm_scope ="all" AND prm_set = "' . $setting . '" and prm_usr_id = "' . $this->usr_id . '"';
		$perms = Database::singleton()->query_fetch($sql);
		if (!is_null($perms)) {
			return true;
		}

		return false;
	}

	public function save() {
		parent::save();

		$e_sql = "SELECT usr_id FROM user WHERE usr_id = '". Database::singleton()->escape($this->usr_id) ."'";
		$e_result = Database::singleton()->query_fetch($e_sql);

		if ($e_result) {
			$start_sql = "UPDATE user SET ";
			$end_sql = "WHERE usr_id = '".Database::singleton()->escape($this->usr_id)."'";
		} else {
			$start_sql = "INSERT INTO user SET ";
			$end_sql = ", usr_id = '".Database::singleton()->escape($this->usr_id)."'";
		}

		$core_sql = "
				usr_sex = 				'".Database::singleton()->escape($this->sex)."',
				usr_birthday = 			'".Database::singleton()->escape($this->birthday)."',
				usr_profile_picture = 	'".Database::singleton()->escape($this->profile_picture)."', 
				usr_biography = 		'".Database::singleton()->escape($this->biography)."',
				usr_interests = 		'".Database::singleton()->escape($this->interests)."',
				usr_work = 				'".Database::singleton()->escape($this->work)."',
				usr_education = 		'".Database::singleton()->escape($this->education)."',
				usr_school = 			'".Database::singleton()->escape($this->school)."',
				usr_looking_for = 		'".Database::singleton()->escape($this->looking_for)."',
				usr_last_touched =      NOW()
				";

		$sql = $start_sql.$core_sql.$end_sql;
		return Database::singleton()->query($sql);
	}

	/*
	 * @todo Not currently deleting group memberships or friends or friends queues
	 */
	public function delete() {
		$parent_result = parent::delete();

		$result = false;

		$sql = "DELETE FROM user WHERE usr_id = '". Database::singleton()->escape($this->usr_id) ."'";
		$child_result = Database::singleton()->query($sql);

		$result = ($parent_result && $child_result) ? true : false;

		return $result;
	}

	/*
	 * @todo update with other priv functions
	 */
	public function updatePriv($option, $setting) {
		//var_dump($setting);
		$user = $_SESSION['authenticated_user'];
		$sql = 'delete from user_permissions where `prm_set` = "' . $option . '" and prm_usr_id="' . $user->getId() . '"';
		Database::singleton()->query($sql);
		
		if (is_null($setting)) {
			return;
		}
		
		foreach ($setting as $group) {
			$sql = 'replace into user_permissions SET `prm_set` = "' . $option . '", `prm_scope`="' . $group . '", prm_usr_id="' . $user->getId() . '"';
			Database::singleton()->query($sql);
		}
	}

	public function getOwnerSettings($option = null) {
		if (!$this->isMe()) {
			return false;
		}
		$sql = "SHOW COLUMNS FROM user_permissions LIKE 'prm_scope'";
		$row = Database::singleton()->query_fetch($sql);
		preg_match_all("/'(.*?)'/", $row['Type'], $matches);

		unset($this->privSettings);
		$sql = 'select prm_scope from user_permissions where prm_set LIKE "%' . $option . '%" and prm_usr_id="' . $_SESSION['authenticated_user']->getId() . '"';
		$rows = Database::singleton()->query_fetch_all($sql);
		foreach ($matches[1] as $group) {
			$optionAllowed = false;
			foreach($rows as $allowed) {
				if ($allowed['group'] == $group) {
					$optionAllowed = true;
					break;
				}
			}
			$this->privSettings[] = array('option'=>$group, 'set'=>$optionAllowed);

		}

		return "in progress";
	}


	public function isFriend($fri_usr_id) {
		$sql = "SELECT * FROM user_friends WHERE (fri_usr_id = '". e($fri_usr_id) ."' AND own_usr_id = '" . e($this->usr_id) . "')";
		$result = Database::singleton()->query_fetch($sql);

		if ($result) {
			return true;
		}
		else {
			return false;
		}
	}

	public function isInSameGroup($usr_id) {
		$sql = 'SELECT mem_grp_id FROM user_groups_membership u where mem_usr_id=' . $this->getId() . ' or mem_usr_id=' . $usr_id;
		$r = Database::singleton()->query_fetch_all($sql);

		$groups = array();
		foreach ($r as $group) {
			if (in_array($group['mem_grp_id'], $groups)) {
				return true;
			}
			$groups[] = $group['mem_grp_id'];
		}

		return false;
	}

	public function queueFriend($req_usr_id) {
		$sql = 'INSERT INTO user_friends_queue
				set own_usr_id = "' . Database::singleton()->escape($req_usr_id) . '", 
					req_usr_id = "' . Database::singleton()->escape($this->usr_id) . '"';
		return Database::singleton()->query($sql);
	}

	public function acceptFriend($fri_usr_id) {
		$sql = "INSERT INTO user_friends
				SET own_usr_id = '". e($this->usr_id) ."', 
					fri_usr_id = '". e($fri_usr_id) ."'";
		Database::singleton()->query($sql);

		$sql = "INSERT INTO user_friends
				SET own_usr_id = '". e($fri_usr_id) ."', 
					fri_usr_id = '". e($this->usr_id) ."'";
		Database::singleton()->query($sql);

		$sql = "DELETE from user_friends_queue
				WHERE req_usr_id = '" . e($fri_usr_id) . "' 
				AND   own_usr_id = '" . e($this->usr_id) . "'";
		Database::singleton()->query($sql);
	}

	public function getQueuedFriendRequests() {
		$sql = "SELECT *
				FROM user_friends_queue 
				WHERE own_usr_id = '". e($this->getId()) ."'";
		$queued_friends = Database::singleton()->query_fetch_all($sql);

		foreach ($queued_friends as &$request) {
			$request = new User_Profile($request['req_usr_id']);
		}
		return $queued_friends;
	}

	public function getUserDetailsForm($page_submit = '/user/editbasic') {
		$form = new Form('account_addedit', 'post', $page_submit, '', array('onsubmit' => 'return !submitform(this);'));

		$defaultValues['name'] = $this->name;
		$defaultValues['interests'] = $this->interests;
		$defaultValues['work'] = $this->work;
		$defaultValues['biography'] = $this->biography;
		$defaultValues['education'] = $this->education;
		$defaultValues['school'] = $this->school;
		$defaultValues['birthday'] = $this->birthday;
		$defaultValues['sex'] = $this->sex;
		$defaultValues['looking_for'] = $this->looking_for;

		$form->addElement('text', 'name', 'Full Name');
		$form->addElement('textarea', 'biography', 'Biography');
		$form->addElement('textarea', 'interests', 'Interests');
		$form->addElement('text', 'work', 'Work');
		$form->addElement('text', 'education', 'Education');
		$form->addElement('text', 'school', 'School');

		$dateOptions = array(
			'format'=>'dMY', 
			'minYear'=>1900, 
			'maxYear'=>date('Y')
		);

		$form->addElement('date', 'birthday', 'Birthday', $dateOptions);
		$form->addElement('select', 'sex', 'Sex', array('Male'=>'Male', 'Female'=>'Female'));
		$form->addElement('textarea', 'looking_for', 'Looking For');
		$form->addElement('submit', 'submit', 'Update');

		$form->setDefaults($defaultValues);

		if ($form->validate()) {
			$this->setName(@$_REQUEST['name']);
			$this->setInterests(@$_REQUEST['interests']);
			$this->setWork(@$_REQUEST['work']);
			$this->setBiography(@$_REQUEST['biography']);
			$this->setEducation(@$_REQUEST['education']);
			$this->setSchool(@$_REQUEST['school']);
			$this->setBirthday(@$_REQUEST['birthday']);
			$this->setSex(@$_REQUEST['sex']);
			$this->setLookingFor(@$_REQUEST['looking_for']);
			$this->save();
		}
		return $form;
	}

	public function getUserProfilePicForm($page_submit = '/user/editprofilepic') {
		$form = new Form('account_addedit', 'post', $page_submit, '', array('onsubmit' => 'return !submitfileuploadform(this);'));

		$pic =& $form->addElement('html', '<img src="/images/image.php?id=' . $this->profile_picture . '&h=60" id="profilepic" />');
		$file =& $form->addElement('file', 'profile_pic', 'Upload new Profile Picture');
		$form->addElement('submit', 'submit', 'Update');

		$form->addRule('profile_pic', 'Choose file', 'uploadedFile');

		if ($form->validate()) {
			$this->setProfilePic($file);
			$pic->setText('<img src="/images/image.php?id=' . $this->getProfilePic() . '&h=60" id="profilepic" />');
			$this->save();
		}
		return $form;
	}

	public static function getUserProfiles() {
		$sql = "SELECT auth.aut_id, auth.aut_username, user.usr_name, user.usr_email FROM auth LEFT JOIN  user ON (aut_id = usr_id)";
		$sql_result = Database::singleton()->query_fetch_all($sql);
		$sql_result = Database::singleton()->unescape($sql_result);

		$user_profiles = array();
		foreach ($sql_result as $user_profile) {
			$user_profiles[$user_profile['aut_id']] = new User_Profile();
			$user_profiles[$user_profile['aut_id']]->setId($user_profile['aut_id']);
			$user_profiles[$user_profile['aut_id']]->setUsername($user_profile['aut_username']);
			$user_profiles[$user_profile['aut_id']]->setName($user_profile['usr_name']);
			$user_profiles[$user_profile['aut_id']]->setEmail($user_profile['usr_email']);
		}

		return $user_profiles;
	}

	public function __toString() {
		return "User's name: ".$this->getName();
	}
}

?>
