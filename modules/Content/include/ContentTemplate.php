<?php
/**
 * ContentTemplate
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
class ContentTemplate {

	/**
	 * Variable associated with `id` column in table.
	 *
	 * @var string
	 */
	protected $id = null;
	
	/**
	 * Variable associated with `name` column in table.
	 *
	 * @var string
	 */
	protected $name = null;
	
	/**
	 * Variable associated with `description` column in table.
	 *
	 * @var string
	 */
	protected $description = null;
	
	
	/**
	 * Variable associated with `content` column in table.
	 *
	 * @var string
	 */
	protected $content = null;
	
	/**
	 * Variable associated with `preview_image` column in table.
	 *
	 * @var string
	 */
	protected $preview_image = null;
	
	/**
	 * Create an instance of the ContentTemplate class.
	 * 
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template ContentTemplate object is returned.
	 *
	 * @param int $id
	 * @return ContentTemplate object
	 */
	public function __construct( $id = null ) {
		if (!is_null($id)) {
			$sql = 'select * from content_templates where id=' . $id;
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}

			$this->setId($result['id']);
			$this->setName($result['name']);
			$this->setDescription($result['description']);
			$this->setContent($result['content']);
			$this->setPreview_image($result['preview_image']);
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
	 * Returns the object's Name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * Returns the object's Description
	 *
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
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
	 * Returns the object's Preview_image
	 *
	 * @return string
	 */
	public function getPreview_image() {
		return $this->preview_image;
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
	 * Sets the object's Name
	 *
	 * @param string $name New $this->name value
	 */
	public function setName( $name ) {
		$this->name = $name;
	}

	/**
	 * Sets the object's Description
	 *
	 * @param string $description New $this->description value
	 */
	public function setDescription( $description ) {
		$this->description = $description;
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
	 * Sets the object's Preview_image
	 *
	 * @param string $preview_image New $this->preview_image value
	 */
	public function setPreview_image( $preview_image ) {
		$this->preview_image = $preview_image;
	}


	/**
	 * Save the object in the database
	 */
	public function save() {
		if (!is_null($this->id)) {
			$sql = 'update content_templates set ';
		} else {
			$sql = 'insert into content_templates set ';
		}
		$sql .= '`name`="' . e($this->name) . '", ';
		$sql .= '`description`="' . e($this->description) . '", ';
		$sql .= '`content`="' . e($this->content) . '", ';
		$sql .= '`preview_image`="' . e($this->preview_image) . '", ';
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
		$sql = 'delete from content_templates where id="' . e($this->id) . '"';
		Database::singleton()->query($sql);
	}

	/**
	 * Get an Add/Edit form for the object.
	 *
	 * @param string $target Post target for form submission
	 */
	public function getAddEditForm($target = '/admin/Content') {
		$form = new Form('ContentTemplate_addedit', 'post', $target);
		
		$form->setConstants( array ( 'section' => 'templates' ) );
		$form->addElement( 'hidden', 'section' );
		
		if (!is_null($this->id)) {
			$form->setConstants( array ( 'contenttemplate_id' => $this->getId() ) );
			$form->addElement( 'hidden', 'contenttemplate_id' );
			
			$defaultValues ['contenttemplate_name'] = $this->getName();
			$defaultValues ['contenttemplate_description'] = $this->getDescription();
			$defaultValues ['contenttemplate_content'] = $this->getContent();
			$defaultValues ['contenttemplate_preview_image'] = $this->getPreview_image();

			$form->setDefaults( $defaultValues );
		}
					
		$form->addElement('text', 'contenttemplate_name', 'name /* Fill in text */');
		$form->addElement('text', 'contenttemplate_description', 'description /* Fill in text */');
		$form->addElement('text', 'contenttemplate_content', 'content /* Fill in text */');
		$form->addElement('text', 'contenttemplate_preview_image', 'preview_image /* Fill in text */');
		$form->addElement('submit', 'contenttemplate_submit', 'Submit');

		if ($form->validate() && $form->isSubmitted()) {
			$this->setName($form->exportValue('contenttemplate_name'));
			$this->setDescription($form->exportValue('contenttemplate_description'));
			$this->setContent($form->exportValue('contenttemplate_content'));
			$this->setPreview_image($form->exportValue('contenttemplate_preview_image'));
			$this->save();
		}

		return $form;
		
	}
	
	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllContentTemplates() {
		$sql = 'select `id` from content_templates';
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new ContentTemplate($result['id']);
		}
		
		return $results;
	}
	
}
?>