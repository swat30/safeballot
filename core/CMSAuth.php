<?php
include_once 'Auth/Auth.php';
include_once 'Auth/Container.php';

class CMSAuth extends Auth
{
	
	function CMSAuth($storageDriver, $options = '', $loginFunction = '', $showLogin = true){
		parent::Auth($storageDriver, $options, $loginFunction, $showLogin);
	}
	
 	public function getError(){
 		switch ($this->status) {
 			case -3:
 				if(empty($_POST['password'])){
 					return 'No password was entered';
 				}
 				return 'Invalid username/password';
 			default:
 				if(array_key_exists('username', $_POST) && array_key_exists('password', $_POST)){
 					return 'No username was entered';
 				}
 		}
 		return false;
 	}
	
}
?>