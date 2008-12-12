<?php
/**
 * SupportTicket
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
class SupportTicket {

	/**
	 * Variable associated with `id` column in table.
	 *
	 * @var string
	 */
	protected $id = null;

	/**
	 * Variable associated with `owner` column in table.
	 *
	 * @var string
	 */
	protected $owner = null;

	/**
	 * Variable associated with `ticket_id` column in table.
	 *
	 * @var string
	 */
	protected $ticket_id = null;

	/**
	 * Variable associated with `title` column in table.
	 *
	 * @var string
	 */
	protected $title = null;

	/**
	 * Create an instance of the SupportTicket class.
	 *
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template SupportTicket object is returned.
	 *
	 * @param int $id
	 * @return SupportTicket object
	 */
	public function __construct( $id = null ) {
		$this->soap = new SoapClient('http://bugs.clientview.ca/mc/mantisconnect.php?wsdl');
		if (!is_null($id)) {
			$sql = 'select * from support where id=' . $id;
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}

			$this->setId($result['id']);
			$this->setOwner($result['owner']);
			$this->setTicket_id($result['ticket_id']);
			$this->setTitle($result['title']);
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
	 * Returns the object's Owner
	 *
	 * @return string
	 */
	public function getOwner() {
		return $this->owner;
	}

	/**
	 * Returns the object's Ticket_id
	 *
	 * @return string
	 */
	public function getTicket_id() {
		return $this->ticket_id;
	}

	/**
	 * Returns the object's Title
	 *
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
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
	 * Sets the object's Owner
	 *
	 * @param string $owner New $this->owner value
	 */
	public function setOwner( $owner ) {
		$this->owner = new User($owner);
	}

	/**
	 * Sets the object's Ticket_id
	 *
	 * @param string $ticket_id New $this->ticket_id value
	 */
	public function setTicket_id( $ticket_id ) {
		$this->ticket_id = $ticket_id;
	}

	/**
	 * Sets the object's Title
	 *
	 * @param string $title New $this->title value
	 */
	public function setTitle( $title ) {
		$this->title = $title;
	}


	/**
	 * Save the object in the database
	 */
	public function save() {
		if (!is_null($this->id)) {
			$sql = 'update support set ';
		} else {
			$sql = 'insert into support set ';
		}
		$sql .= '`owner`="' . e($this->owner->getId()) . '", ';
		$sql .= '`ticket_id`="' . e($this->ticket_id) . '", ';
		$sql .= '`title`="' . e($this->title) . '", ';
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
		$sql = 'delete from support where id="' . e($this->id) . '"';
		Database::singleton()->query($sql);
	}

	/**
	 * Get an Add/Edit form for the object.
	 *
	 * @param string $target Post target for form submission
	 */
	public function getAddEditForm($target = '/admin/Support') {
		$form = new Form( 'support_form', 'POST', $target, '', array ( 'class' => 'admin' ) );
		$form->addElement('select','project', 'Project', $this->getSoapUserProjects());
		$form->addElement('select','type', 'Type of problem', $this->getSoapCategories());
		$form->addElement( 'text', 'summary', 'Summary' );
		$form->addElement( 'textarea', 'desc', 'Description', array('rows'=>'6', 'cols'=>'50') );
		$form->addElement('submit', 'submit', 'Submit');

		$form->addRule('summary','Please enter a short summary', 'required', null, 'client');
		$form->addRule('type','Please choose a bug type', 'required', null, 'client');
		$form->addRule('desc','Please enter a description', 'required', null, 'client');

		$extraData = $_SERVER['HTTP_USER_AGENT'];
		$extraData .= "\n";
		$extraData .= 'Site: ' . $_SERVER['SERVER_NAME'] . "\n";
		$extraData .= 'Username: ' . $_SESSION['authenticated_user']->getUsername() . "\n";
		$extraData .= 'Realname: ' . $_SESSION['authenticated_user']->getName() . "\n";
		
		if ($form->validate()) {
			$issue = array(
			'id' => null,
			'project' => array('id' => $_REQUEST['project'], 'name' => 'norexcms'),
			'view_state' => null,
			'handler' => null,
			'reporter' => null,
			'last_updated' => null,
			'summary' => stripslashes($_REQUEST['summary']),
			'description' => stripslashes($_REQUEST['desc']),
			'priority' => null,
			'severity' => null,
			'status' => null,
			'reproducibility' => null,
			'version' => null,
  			'build' => null,
  			'platform' => null,
  			'os' => null,
  			'os_build' => null,
			'date_submitted' => null,
			'sponsorship_total' => null,
			'projection' => null,
			'eta' => null,
			'resolution' => null,
			'fixed_in_version' => null,
			'steps_to_reproduce' => null,
			'additional_information' => stripslashes($extraData),
			'attachments' => null,
			'relationships' => null,
			'notes' => null,
			'custom_fields' => array(array('field' => array('id'=>1, 'name'=>'site'), 'value' => $_SERVER['SERVER_NAME'])),
			'category' => stripslashes($_REQUEST['type']));

			$issueID = $this->soap->__call('mc_issue_add', array(
				'username' => MANTIS_USER, 
				'password' => MANTIS_PASSWORD,
				'issue' => $issue));

			$this->setTicket_id($issueID);
			$this->setOwner($_SESSION['authenticated_user']->getId());
			$this->setTitle($_REQUEST['summary']);
			$this->save(); 
			
		}
		return $form;

	}

	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllSupportTickets() {
		$sql = 'select `id` from support';
		$results = Database::singleton()->query_fetch_all($sql);

		foreach ($results as &$result) {
			$result = new SupportTicket($result['id']);
		}

		return $results;
	}

	public static function getUserSupportTickets() {
		$sql = 'select `id` from support where `owner`=' . e($_SESSION['authenticated_user']->getId());
		$results = Database::singleton()->query_fetch_all($sql);

		foreach ($results as &$result) {
			$result = new SupportTicket($result['id']);
		}

		return $results;
	}

	function getSoapCategories($project = 5) {
		$cats = ($this->soap->__call('mc_project_get_categories', array(MANTIS_USER, MANTIS_PASSWORD, $project)));
		$types = array();
		foreach($cats as $key => $cat) {
			$types[$cat] = $cat;
		}
		return $types;
	}

	function getSoapUserProjects() {
		$projects = $this->soap->__call('mc_projects_get_user_accessible', array(MANTIS_USER, MANTIS_PASSWORD));
		$projects = array($projects[0]->id => $projects[0]->description);
		return $projects;
	}

	public function getSoapBugDetails() {
		$issue = new stdClass();
		$issue = ($this->soap->__call('mc_issue_get', array(MANTIS_USER, MANTIS_PASSWORD, $this->getTicket_id())));
		return $issue;
	}

}
?>