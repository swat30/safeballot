<?php

require_once('CMSPageRevision.php');

class CMSPage {

	protected $id = null;
	protected $pageName = null;
	protected $timestamp = null;
	protected $status = null;
	protected $access = null;

	public function __construct( $id = null ) {
		if (!is_null($id)) {
			if (is_numeric($id)) {
				$sql = 'select * from content_pages where id=' . $id;
			} else {
				$sql = 'select * from content_pages where page_name="' . $id . '"';
			}
			$result = Database::singleton()->query_fetch($sql);

			$this->id = $result['id'];
			$this->pageName = $result['page_name'];
			$this->timestamp = $result['timestamp'];
			$this->status = $result['status'];
			$this->access = @$result['access'];
		}
	}
	
	public function getActiveRevisions($languageCode = null) {
		return CMSPageRevision::active($this->id, $languageCode);
	}
	
	public static function getContentPages() {
		$sql = 'SELECT id from content_pages';
		$ps = Database::singleton()->query_fetch_all($sql);
		foreach ($ps as &$p) {
			$p = new CMSPage($p['id']);
		}
		return $ps;
	}

	public function getId() {
		return $this->id;
	}

	public function getPageName() {
		return $this->pageName;
	}

	public function getTimestamp() {
		return $this->timestamp;
	}

	public function getStatus() {
		return $this->status;
	}

	public function getAccess() {
		return $this->access;
	}
	
	public function setId( $id ) {
		$this->id = $id;
	}

	public function setPageName( $pageName ) {
		$this->pageName = $pageName;
	}

	public function setTimestamp( $timestamp ) {
		$this->timestamp = $timestamp;
	}

	public function setStatus( $status ) {
		$this->status = $status;
	}
	
	public function setAccess( $access ){
		$this->access = $access;
	}

	public function save() {
		if (!is_null($this->id)) {
			$sql = 'update content_pages set ';
		} else {
			$sql = 'insert into content_pages set ';
		}
		$sql .= 'page_name="' . e($this->pageName) . '", ';
		$sql .= 'timestamp="' . e($this->timestamp) . '", ';
		$sql .= 'status="' . e($this->status) . '", ';
		$sql .= 'access="' . e($this->access) . '", ';
		if (!is_null($this->id)) {
			$sql .= 'id="' . e($this->id) . '" where id="' . $this->id . '"';
		} else {
			$sql = trim($sql, ', ');
		}
		Database::singleton()->query($sql);
		if (is_null($this->id)) {
			$this->id = Database::singleton()->lastInsertedID();
		}
		if(Config::getIsModuleActive('Menu')){
			include('../modules/Menu/Menu.php');
			Module_Menu::insertMenu();
		}
	}

	public function delete() {
		$sql = 'delete from content_pages where id="' . e($this->id) . '"';
		Database::singleton()->query($sql);
	}
	
	public function getForm($target = '/admin/Content') {
		$form = new Form ( 'content_addedit', 'POST', $target, '', array ('class' => 'admin' ) );
		
		$form->addElement ( 'text', 'urlkey', 'Page URL Key' );
		if(Module_Content::hasRestriction()){
			$form->addElement ( 'select', 'access', 'Page Access', array('public' => 'Public', 'restricted' => 'Restricted'));
		} else {
			$form->addElement ('hidden', 'access', '', 'public');
		}
		
		$form->addElement ( 'text', 'metatitle', 'SEO Title', array ('style' => 'width: 70%;' ) );
		$form->addElement ( 'text', 'metadesc', 'SEO Description', array ('style' => 'width: 70%;' ) );
		$form->addElement ( 'text', 'metakeywords', 'SEO Keywords', array ('style' => 'width: 70%;' ) );
				
		$form->applyFilter ( 'urlkey', 'trim' );
		$form->addRule ( 'urlkey', 'Please enter a URL key', 'required', null, 'client' );
		
		$form->addElement ( 'submit', 'submit', 'Continue' );
		
		if ($form->validate() && isset($_REQUEST['submit'])) {
			$this->setPageName($form->exportValue('urlkey'));
			$this->setTimestamp(date('Y-m-d H:i:s'));
			$metadata['title'] = $form->exportValue('metatitle');
			$metadata['description'] = $form->exportValue('metadesc');
			$metadata['keywords'] = $form->exportValue('metakeywords');
			$_SESSION['metadata'] = $metadata;
			$this->setAccess($form->exportValue('access'));
			$this->save();
		}
		
		return $form;
	}
}

?>