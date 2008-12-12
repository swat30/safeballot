<?php

require_once 'core/User.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * User test case.
 */
class UserTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var User
	 */
	private $User;

	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
		// TODO Auto-generated UserTest::setUp()
		

		$this->User = new User();
		$this->User->save();
	}
	
	

	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated UserTest::tearDown()
		$this->User->permDelete();
		$this->User = null;
		
		parent::tearDown ();
	}

	/**
	 * Constructs the test case.
	 */
	public function __construct() {	
	}

	/**
	 * Tests User->__construct()
	 */
	public function test__construct() {
		$this->User->__construct();
		if (get_class($this->User) != 'User') {
			$this->fail();
		}
	}
	
	public function testGetId() {
		if (!is_numeric($this->User->getId())) {
			$this->fail();
		}
	}
	
	public function testSave() {
		if (!$this->User->save()) {
			$this->fail();
		}
	}

	public function testSetId() {
		$oldid = $this->User->getId();
		$this->User->setId(666);
		if ($this->User->getId() != 666) {
			$this->fail();
		}
		$this->User->setId($oldid);
	}
	
	public function testGetName() {
		$this->User->setName('testuser');
		if ($this->User->getName() != 'testuser') {
			$this->fail();
		}
	}
	
	public function testGetUsername() {
		$this->User->setUsername('testuser');
		if ($this->User->getUsername() != 'testuser') {
			$this->fail();
		}
	}
	
	public function testGetEmail() {
		$this->User->setEmail('test@norex.ca');
		if ($this->User->getEmail() != 'test@norex.ca') {
			$this->fail();
		}
	}
	
	public function testGetActiveStatus() {
		$this->User->setActiveStatus(true);
		if ($this->User->getActiveStatus() != true) {
			$this->fail();
		}
	}
	
	public function testGetAuthGroup() {
		$this->User->setAuthGroup(1);
		if ($this->User->getAuthGroup() != 1) {
			$this->fail();
		}
	}

	public function testGetAuthGroupName() {
		$this->User->setAuthGroupName('AdminTest');
		if ($this->User->getAuthGroupName() != 'AdminTest') {
			$this->fail();
		}
	}
	
	public function testGetUsers() {
		if (!is_array($this->User->getUsers())) {
			$this->fail();
		}
	}
	
	public function test__toString() {
		$this->assertEquals($this->User->__toString(), 'User class object');
	}
	
	public function testFetchData() {
		$this->User->setUsername('testuser');
		$this->User->setPassword('testpassword');
		$this->User->setActiveStatus(true);
		$this->User->save();
		if (!$this->User->fetchData('testuser', 'testpassword')) {
			$this->fail();
		}
		
		$this->User->setActiveStatus(false);
		$this->User->save();
		if ($this->User->fetchData('testuser', 'testpassword')) {
			$this->fail('User\'s auth status was set to false but user was authenticated');
		}
	}
}

