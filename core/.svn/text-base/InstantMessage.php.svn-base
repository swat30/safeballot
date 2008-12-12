<?php

/**
 * InstantMessage
 * @author Christopher Troup <chris@norex.ca>
 * @package CMS
 * @version 2.0
 */

/**
 * DETAILED CLASS TITLE
 * 
 * DETAILED DESCRIPTION OF THE CLASS
 * @package CMS
 * @subpackage Core
 */
class InstantMessage {

	/**
	 * Variable associated with `id` column in table.
	 *
	 * @var string
	 */
	protected $id = null;
	
	/**
	 * Variable associated with `from` column in table.
	 *
	 * @var string
	 */
	protected $from = null;
	
	/**
	 * Variable associated with `to` column in table.
	 *
	 * @var string
	 */
	protected $to = null;
	
	/**
	 * Variable associated with `namespace` column in table.
	 *
	 * @var string
	 */
	protected $namespace = null;
	
	/**
	 * Variable associated with `thread` column in table.
	 *
	 * @var string
	 */
	protected $thread = null;
	
	/**
	 * Variable associated with `message` column in table.
	 *
	 * @var string
	 */
	protected $message = null;
	
	/**
	 * Variable associated with `read` column in table.
	 *
	 * @var string
	 */
	protected $read = null;
	
	/**
	 * Variable associated with `timestamp` column in table.
	 *
	 * @var string
	 */
	protected $timestamp = null;
	
	/**
	 * Create an instance of the InstantMessage class.
	 * 
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template InstantMessage object is returned.
	 *
	 * @param int $id
	 * @return InstantMessage object
	 */
	public function __construct( $id = null ) {
		if (!is_null($id)) {
			$sql = 'select * from instant_messages where id=' . $id;
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}

			$this->setId($result['id']);
			$this->setFrom($result['from']);
			$this->setTo($result['to']);
			$this->setNamespace($result['namespace']);
			$this->setThread($result['thread']);
			$this->setMessage($result['message']);
			$this->setRead($result['read']);
			$this->setTimestamp($result['timestamp']);
		}
	}

	/**
	 * Returns the object's Id
	 *
	 * @return string
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Returns the object's From
	 *
	 * @return string
	 */
	public function getFrom() {
		return $this->from;
	}

	/**
	 * Returns the object's To
	 *
	 * @return string
	 */
	public function getTo() {
		return $this->to;
	}

	/**
	 * Returns the object's Namespace
	 *
	 * @return string
	 */
	public function getNamespace() {
		return $this->namespace;
	}

	/**
	 * Returns the object's Thread
	 *
	 * @return string
	 */
	public function getThread() {
		return $this->thread;
	}

	/**
	 * Returns the object's Message
	 *
	 * @return string
	 */
	public function getMessage() {
		return stripslashes($this->message);
	}

	/**
	 * Returns the object's Read
	 *
	 * @return string
	 */
	public function getRead() {
		return $this->read;
	}

	/**
	 * Returns the object's Timestamp
	 *
	 * @return string
	 */
	public function getTimestamp() {
		return $this->timestamp;
	}

	/**
	 * Sets the object's Id
	 *
	 * @param string $id New $this->id value
	 */
	public function setId( $id ) {
		$this->id = $id;
	}

	/**
	 * Sets the object's From
	 *
	 * @param string $from New $this->from value
	 */
	public function setFrom( $from ) {
		$this->from = new User($from);
	}

	/**
	 * Sets the object's To
	 *
	 * @param string $to New $this->to value
	 */
	public function setTo( $to ) {
		$this->to = new User($to);
	}

	/**
	 * Sets the object's Namespace
	 *
	 * @param string $namespace New $this->namespace value
	 */
	public function setNamespace( $namespace ) {
		$this->namespace = $namespace;
	}

	/**
	 * Sets the object's Thread
	 *
	 * @param string $thread New $this->thread value
	 */
	public function setThread( $thread ) {
		$this->thread = $thread;
	}

	/**
	 * Sets the object's Message
	 *
	 * @param string $message New $this->message value
	 */
	public function setMessage( $message ) {
		$this->message = strip_tags($message);
	}

	/**
	 * Sets the object's Read
	 *
	 * @param string $read New $this->read value
	 */
	public function setRead( $read ) {
		$this->read = $read;
	}

	/**
	 * Sets the object's Timestamp
	 *
	 * @param string $timestamp New $this->timestamp value
	 */
	public function setTimestamp( $timestamp ) {
		$this->timestamp = $timestamp;
	}


	/**
	 * Save the object in the database
	 */
	public function save() {
		if ($this->getMessage() == null) return false;
		
		if (!is_null($this->id)) {
			$sql = 'update instant_messages set ';
		} else {
			$sql = 'insert into instant_messages set ';
		}
		$sql .= '`from`="' . e($this->from->getId()) . '", ';
		$sql .= '`to`="' . e($this->to->getId()) . '", ';
		$sql .= 'namespace="' . e($this->namespace) . '", ';
		$sql .= 'thread="' . e($this->thread) . '", ';
		$sql .= 'message="' . e($this->message) . '", ';
		if (!is_null($this->id)) {
			$sql .= 'id="' . e($this->id) . '" where id="' . $this->id . '"';
		} else {
			$sql = trim($sql, ', ');
		}
		Database::singleton()->query($sql);
		if (is_null($this->id)) {
			$this->id = Database::singleton()->lastInsertedID();
			self::__construct($this->id);
		}
	}

	/**
	 * Delete the object from the database
	 */
	public function delete() {
		$sql = 'delete from instant_messages where id="' . e($this->id) . '"';
		Database::singleton()->query($sql);
	}

	/**
	 * Get an Add/Edit form for the object.
	 *
	 * @param string $target Post target for form submission
	 */
	public function getAddEditForm($target = '/admin/InstantMessage') {
		$form = new Form('InstantMessage_addedit', 'post', $target);
		
		$form->setConstants( array ( 'section' => 'addedit' ) );
		$form->addElement( 'hidden', 'section' );
		
		if (!is_null($this->id)) {
			$form->setConstants( array ( 'instantmessage_id' => $this->getId() ) );
			$form->addElement( 'hidden', 'instantmessage_id' );
			
			$defaultValues ['instantmessage_from'] = $this->getFrom()->getId();
			$defaultValues ['instantmessage_to'] = $this->getTo()->getId();
			$defaultValues ['instantmessage_namespace'] = $this->getNamespace();
			$defaultValues ['instantmessage_thread'] = $this->getThread();
			$defaultValues ['instantmessage_message'] = $this->getMessage();
			$defaultValues ['instantmessage_read'] = $this->getRead();
			$defaultValues ['instantmessage_timestamp'] = $this->getTimestamp();

			$form->setDefaults( $defaultValues );
		}
					
		$form->addElement('text', 'instantmessage_from', 'from /* Fill in text */');
		$form->addElement('text', 'instantmessage_to', 'to /* Fill in text */');
		$form->addElement('text', 'instantmessage_namespace', 'namespace /* Fill in text */');
		$form->addElement('text', 'instantmessage_thread', 'thread /* Fill in text */');
		$form->addElement('text', 'instantmessage_message', 'message /* Fill in text */');
		$form->addElement('text', 'instantmessage_read', 'read /* Fill in text */');
		$form->addElement('text', 'instantmessage_timestamp', 'timestamp /* Fill in text */');
		$form->addElement('submit', 'instantmessage_submit', 'Submit');

		if ($form->validate() && $form->isSubmitted()) {
			$this->setFrom($form->exportValue('instantmessage_from'));
			$this->setTo($form->exportValue('instantmessage_to'));
			$this->setNamespace($form->exportValue('instantmessage_namespace'));
			$this->setThread($form->exportValue('instantmessage_thread'));
			$this->setMessage($form->exportValue('instantmessage_message'));
			$this->setRead($form->exportValue('instantmessage_read'));
			$this->setTimestamp($form->exportValue('instantmessage_timestamp'));
			$this->save();
		}

		return $form;
		
	}
	
	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllInstantMessages() {
		$sql = 'select `id` from instant_messages';
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new InstantMessage($result['id']);
		}
		
		return $results;
	}
	
}

/*
class InstantMessage {
	
	private $namespace;
	private $to;
	
	public function __construct($namespace, $to) {
		$this->namespace = $namespace;
		$this->to = new User($to);
	}
	
	public function getMessages($thread = null, $lastn = null) {
		if ($thread != null) {
			$thread = ' or `from`="' . $this->to . '") and (`thread`=' . $thread;
		}
		$sql = 'select * from instant_messages where `namespace`="' . $this->namespace . '" and (`to`="' . $this->to . '"' . $thread . ') order by `timestamp` desc';
		if (!is_null($lastn)) {
			$sql .= ' limit ' . $lastn;
		}
		$messages = Database::singleton()->query_fetch_all($sql);
		foreach ($messages as &$message) {
			$message['from'] = new User_Profile($message['from']);
			$message['from']->getProfile();
		}
		return $messages;
	}
	
	public function getThreadedConvo($thread, $lastn = null) {
		$sql = 'select * from instant_messages where `namespace`="' . $this->namespace . 
			'" and (`to`="' . $this->to . '" OR `from`="' . $this->to . '") and `thread`=' . 
			$thread . ' order by `timestamp` asc';
			
		if (!is_null($lastn)) {
			$sql .= ' limit ' . $lastn;
		}
		$messages = Database::singleton()->query_fetch_all($sql);
		foreach ($messages as &$message) {
			$message['from'] = new User_Profile($message['from']);
			$message['from']->getProfile();
		}
		
		return $messages;
	}
	
	public function getConvos() {
		$sql = 'select *, count(*) as count, sum(`read`) as `read` from instant_messages where `namespace`="' . $this->namespace . '" and (`to`="' . $this->to->getId() . '" OR `from`="' . $_SESSION['authenticated_user']->getId() . '") group by `thread` order by `timestamp` desc';
		$messages = Database::singleton()->query_fetch_all($sql);
		foreach ($messages as &$message) {
			$message['from'] = new User_Profile($message['from']);
			$message['from']->getProfile();
			
			$message['to'] = new User_Profile($message['to']);
			$message['to']->getProfile();
		}
		return $messages;
	}
	
	public function addMessage($message) {
		$from_usr_id = $_SESSION['authenticated_user']->getId();
		$sql = 'insert into instant_messages set `from` ="' . $from_usr_id . '", `to`="' . $this->to->getId() . '", `namespace`="' . $this->namespace . '", `message`="' . $message . '"';
		Database::singleton()->query($sql);
	}
	
}
*/
?>