<?php

define('CMSPAGE_INACTIVE', 0);
define('CMSPAGE_ACTIVE', 1);

class CMSPageRevision {

	protected $id = null;
	protected $parentId = null;
	protected $content = null;
	protected $localeId = null;
	protected $timestamp = null;
	protected $status = null;
	protected $pageTitle = null;
	protected $metaTitle = null;
	protected $metaDescription = null;
	protected $metaKeywords = null;

	public function __construct( $id = null ) {
		if (!is_null($id)) {
			$sql = 'select * from content_page_data where id=' . $id;
			$result = Database::singleton()->query_fetch($sql);

			$this->id = $result['id'];
			$this->parentId = $result['parent_id'];
			$this->content = $result['content'];
			$this->localeId = $result['locale_id'];
			$this->timestamp = $result['timestamp'];
			$this->status = $result['status'];
			$this->pageTitle = $result['page_title'];
			$this->metaDescription = $result['meta_description'];
			$this->metaTitle = $result['meta_title'];
			$this->metaKeywords = $result['meta_keywords'];
		}
	}
	
	public static function active($id, $locale) {
		if (!is_null($locale)) {
			$sql = 'select c.id from content_page_data c JOIN (locale l) ON (l.id=c.locale_id) where c.status=' . CMSPAGE_ACTIVE . ' and c.parent_id=' . $id .' and l.code="' . $locale . '"';
			$r = Database::singleton()->query_fetch($sql);
			$revs = new CMSPageRevision($r['id']);
		} else {
			$sql = 'select c.id from content_page_data c where c.status=1 and c.parent_id=' . $id;
			$revs = Database::singleton()->query_fetch_all($sql);
			foreach ($revs as &$rev) {
				$rev = new CMSPageRevision($rev['id']);
			}
		}
		return $revs;
	}
	
	public function createRevision() {
		$rev =& new CMSPageRevision();
		$rev->setParentId($this->parentId);
		$rev->setContent($this->content);
		$rev->setLocaleId($this->localeId);
		$rev->setPageTitle($this->pageTitle);
		$rev->setStatus(CMSPAGE_INACTIVE);
		$rev->setTimestamp(date('Y-m-d H:i:s'));
		$rev->save();
		return $rev;
	}

	public function getId() {
		return $this->id;
	}

	public function getParentId() {
		return $this->parentId;
	}

	public function getContent() {
		return u($this->content);
	}

	public function getLocaleId() {
		return $this->localeId;
	}

	public function getTimestamp() {
		return $this->timestamp;
	}

	public function getStatus() {
		return $this->status;
	}

	public function getPageTitle() {
		return $this->pageTitle;
	}
	
	public function getMetaData(){
		return array('title'=>$this->metaTitle, 'description'=>$this->metaDescription, 'keywords'=>$this->metaKeywords);
	}

	public function setId( $id ) {
		$this->id = $id;
	}

	public function setParentId( $parentId ) {
		$this->parentId = $parentId;
	}

	public function setContent( $content ) {
		$this->content = $content;
	}

	public function setLocaleId( $localeId ) {
		$this->localeId = $localeId;
	}

	public function setTimestamp( $timestamp ) {
		$this->timestamp = $timestamp;
	}

	public function setStatus( $status ) {
		$this->status = $status;
	}

	public function setPageTitle( $pageTitle ) {
		$this->pageTitle = $pageTitle;
	}
	
	public function setMetaData( $meta ){
		if(!is_null($meta['title'])){
			$this->metaTitle = $meta['title'];
		}
		if(!is_null($meta['description'])){
			$this->metaDescription = $meta['description'];
		}
		if(!is_null($meta['keywords'])){
			$this->metaKeywords = $meta['keywords'];
		}
	}

	public function save() {
		if (!is_null($this->id)) {
			$sql = 'update content_page_data set ';
		} else {
			$sql = 'insert into content_page_data set ';
		}
		$sql .= 'parent_id="' . e($this->parentId) . '", ';
		$sql .= 'content="' . e($this->content) . '", ';
		$sql .= 'locale_id="' . e($this->localeId) . '", ';
		$sql .= 'timestamp="' . e($this->timestamp) . '", ';
		$sql .= 'status="' . e($this->status) . '", ';
		$sql .= 'page_title="' . e($this->pageTitle) . '", ';
		if(!is_null($this->metaTitle)){
			$sql .= 'meta_title="' . e($this->metaTitle) . '", ';
		}
		if(!is_null($this->metaDescription)){
			$sql .= 'meta_description="' . e($this->metaDescription) . '", ';
		}
		if(!is_null($this->metaKeywords)){
			$sql .= 'meta_keywords="' . e($this->metaKeywords) . '", ';
		}
		if (!is_null($this->id)) {
			$sql .= 'id="' . e($this->id) . '" where id="' . $this->id . '"';
		} else {
			$sql = trim($sql, ', ');
		}
		Database::singleton()->query($sql);
		if (is_null($this->id)) {
			$this->id = Database::singleton()->lastInsertedID();
		}
	}

	public function delete() {
		$sql = 'delete from content_page_data where id="' . e($this->id) . '"';
		Database::singleton()->query($sql);
	}
	
	public function getAddEditForm() {
		$form = new Form ( 'page_addedit', 'POST', '/admin/Content', '', array ('class' => 'admin' ) );
		$form->addElement ( 'text', 'title', 'Page Title', array ('value' => $this->getPageTitle() ) );
		
		$sql = 'select * from locale order by display_name';
		$rows = Database::singleton()->query_fetch_all ( $sql );
		$languages = array ( );
		foreach ( $rows as $language ) {
			$languages [$language ['id']] = $language ['display_name'];
		}
		
		$form->addElement ( 'select', 'language', 'Language', $languages );
		$defaultValues ['language'] = array ($this->getLocaleId() );
		$form->setDefaults ( $defaultValues );
		
		$form->setConstants ( array ('action' => 'updatePage', 'id' => $this->getId(), 'section' => 'addEdit', 'parent_id' => $this->getParentId() ) );
		$form->addElement ( 'hidden', 'id' );
		$form->addElement ( 'hidden', 'section' );
		$form->addElement ( 'hidden', 'action' );
		
		$oQFElement = HTML_Quickform::createElement ( 'tinymce', 'editor', 'Content' );
		//$oQFElement->setFCKProps ( '/core/fckeditor/', 'Default', '100%', '500', array ('SkinPath' => 'editor/skins/office2003/', 'DefaultLanguage' => 'en', 'StylesXmlPath' => '/core/fckeditor/fckstyles.xml', 'UseBROnCarriageReturn' => 'true', 'StartupFocus' => 'false', 
		//		'CustomConfigurationsPath' => 'config.js', 'EditorAreaCSS' => 'fck_editorarea.css' ) );
		$oQFElement->setValue ( $this->getContent() );
		$form->addElement ( $oQFElement );
		
		$form->addElement ( 'submit', 'submit', 'Save and auto-publish', array ('id' => 'submit' ) );
		$form->addElement ( 'submit', 'submit_leavestatus', 'Save (but don\'t publish)' );
		
		$form->applyFilter ( 'urlkey', 'title' );
		$form->addRule ( 'title', 'Please enter a Page Title', 'required', null, 'client' );
		$form->addRule ( 'editor', 'Please enter some Page Content', 'required', null, 'client' );
		
		if ($form->validate() && (isset($_REQUEST['submit']) || isset($_REQUEST['submit_leavestatus']))) {
			$this->setContent($_REQUEST['editor']);
			$this->setLocaleId($_REQUEST['language']);
			$this->setPageTitle($_REQUEST['title']);
			$this->setTimestamp(date('Y-m-d H:i:s'));
			$this->setMetaData($_SESSION['metadata']);
			
			if (isset($_REQUEST['submit'])) {
				$this->setStatus(true);
			}
			
			$this->save();
		}
		
		return $form;
	}
}

?>