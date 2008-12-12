<?php
/**
 * Blocks
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
class Block {

	/**
	 * Variable associated with `id` column in table.
	 *
	 * @var string
	 */
	protected $id = null;

	/**
	 * Variable associated with `title` column in table.
	 *
	 * @var string
	 */
	protected $title = null;
	
	/**
	 * Variable associated with `timestamp` column in table.
	 *
	 * @var string
	 */
	protected $timestamp = null;

	/**
	 * Variable associated with `content` column in table.
	 *
	 * @var string
	 */
	protected $content = null;

	/**
	 * Variable associated with `status` column in table.
	 *
	 * @var string
	 */
	protected $status = null;

	/**
	 * Variable associated with `sort` column in table.
	 *
	 * @var string
	 */
	protected $sort = null;

	/**
	 * Create an instance of the Blocks class.
	 *
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template Blocks object is returned.
	 *
	 * @param int $id
	 * @return Blocks object
	 */
	public function __construct( $id = null ) {
		if (!is_null($id)) {
			$sql = 'select * from blocks where id=' . $id;
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}

			$this->setId($result['id']);
			$this->setTitle($result['title']);
			$this->setTimestamp($result['timestamp']);
			$this->setContent($result['content']);
			$this->setStatus($result['status']);
			$this->setSort($result['sort']);
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
	 * Returns the object's Title
	 *
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}
	
	/**
	 * Returns the object's most recent Timestamp
	 *
	 * @return string
	 */
	public function getTimestamp() {
		return $this->timestamp;
	}

	/**
	 * Returns the object's Content
	 *
	 * @return string
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * Returns the object's Status
	 *
	 * @return string
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * Returns the object's Sort
	 *
	 * @return string
	 */
	public function getSort() {
		return $this->sort;
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
	 * Sets the object's Title
	 *
	 * @param string $title New $this->title value
	 */
	public function setTitle( $title ) {
		$this->title = $title;
	}
	
	/** 
	 * Sets the object's most recent Timestamp
	 *
	 * @param string $timestamp New $this->timestamp value
	 */
	public function setTimestamp( $timestamp ) {
		$this->timestamp = $timestamp;
	}

	/**
	 * Sets the object's Content
	 *
	 * @param string $content New $this->content value
	 */
	public function setContent( $content ) {
		$this->content = $content;
	}

	/**
	 * Sets the object's Status
	 *
	 * @param string $status New $this->status value
	 */
	public function setStatus( $status ) {
		$this->status = $status;
	}

	/**
	 * Sets the object's Sort
	 *
	 * @param string $sort New $this->sort value
	 */
	public function setSort( $sort ) {
		$this->sort = $sort;
	}


	/**
	 * Save the object in the database
	 */
	public function save() {
		if (!is_null($this->id)) {
			$sql = 'update blocks set ';
		} else {
			$sql = 'insert into blocks set ';
			$this->status = 'active';
		}
		$sql .= '`title`="' . e($this->title) . '", ';
		$sql .= '`content`="' . e($this->content) . '", ';
		$sql .= '`status`="' . e($this->status) . '", ';
		$sql .= '`sort`="' . e($this->sort) . '", ';
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
		$sql = 'delete from blocks where id="' . e($this->id) . '"';
		Database::singleton()->query($sql);
	}

	/**
	 * Get an Add/Edit form for the object.
	 *
	 * @param string $target Post target for form submission
	 */
	public function getAddEditForm($target = '/admin/Blocks') {
		$form = new Form('Blocks_addedit', 'post', $target);

		$form->setConstants( array ( 'section' => 'addedit' ) );
		$form->addElement( 'hidden', 'section' );

		if (!is_null($this->id)) {
			$form->setConstants( array ( 'blocks_id' => $this->getId() ) );
			$form->addElement( 'hidden', 'blocks_id' );
				
			$defaultValues ['blocks_title'] = $this->getTitle();
			$defaultValues ['blocks_content'] = $this->getContent();
			$defaultValues ['blocks_status'] = $this->getStatus();
			$defaultValues ['blocks_sort'] = $this->getSort();

			$form->setDefaults( $defaultValues );
		}
			
		$form->addElement('text', 'blocks_title', 'Title');
		$form->addElement('tinymce', 'blocks_content', 'Content');
		$form->addElement('submit', 'blocks_submit', 'Submit');

		if ($form->validate() && $form->isSubmitted()) {
			$this->setTitle($form->exportValue('blocks_title'));
			$this->setContent($form->exportValue('blocks_content'));
			$this->save();
		}

		return $form;

	}

	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllBlockss($status = null) {
		if (is_null($status)) {
			$sql = 'select `id` from blocks';
		} else {
			$sql = 'select `id` from blocks where `status`="' . $status . '"';
		}
		
		$results = Database::singleton()->query_fetch_all($sql);

		foreach ($results as &$result) {
			$result = new Block($result['id']);
		}

		return $results;
	}

}
?>