<?php

/**
 * Content Module
 * @author Christopher Troup <chris@norex.ca>
 * @package Modules
 * @version 2.0
 */

/**
 * Content management for the CMS. 
 * 
 * Add, edit and delete user editable content pages.
 * @package Modules
 * @subpackage Content
 */
class Module_Content extends Module {
	
	public $version = '$Id: Content.php 6649 2008-07-31 16:48:27Z chris $';

	/**
	 * Return a string containing the admin interface for the Content Module
	 *
	 * @return string
	 */
	public function getAdminInterface() {
		include ('include/CMSPage.php');
		$this->smarty->assign('hasRestriction',$this->hasRestriction());
		switch ( @$_REQUEST ['section']) {
			case 'viewLayers' :
				switch ( @$_REQUEST ['action']) {
					case 'deleteRev' :
						$this->deleteRev ( $_REQUEST ['id'] );
						$this->topLevelInterface ();
						break;
					default :
						$this->viewLayers ( $_REQUEST ['id'] );
						break;
				}
				break;
			case 'deletePage' :
				$page = new CMSPage($_REQUEST ['id']);
				$page->delete();
				$this->topLevelInterface ();
				break;
			case 'wizard' :
				if (@isset ( $_REQUEST ['wizardStep'] )) {
					$this->startWizard ( @$_REQUEST ['wizardStep'] + 1);
				} else {
					$this->startWizard ();
				}
				break;
			case 'templates':
				$this->addJS('/modules/Content/js/admin.js');
				require_once ('include/ContentTemplate.php');
				$templates = ContentTemplate::getAllContentTemplates();
				$this->smarty->assign('templates', $templates);
				return $this->smarty->fetch('admin/content_templates.tpl');
				break;
			case 'addEdit' :
				switch ( @$_REQUEST ['action']) {
					case 'createRev' :
						$this->createRev ( $_REQUEST ['id'] );
						break;
					case 'updatePage' :
						$this->updateRev ();
						$this->topLevelInterface ();
						break;
					case 'editMeta':
						$this->getMetaEditor(@$_REQUEST['id']);
						$this->template = 'admin/content_addedit.tpl';
						if (isset($_REQUEST['submit'])) {
							$this->topLevelInterface ();
						}
						break;
				}
				break;
			case 'toggle':
				$page = new CMSPage($_REQUEST['id']);
				if ($page->getAccess() == 'public') {
					$page->setAccess('restricted');
					$page->save();
				} else {
					$page->setAccess('public');
					$page->save();
				}
				 $this->topLevelInterface();
				break;
			default :
				switch ( @$_REQUEST ['action']) {
					default :
						$this->topLevelInterface ();
						break;
				}
		
		}
		return $this->smarty->fetch ( $this->template );
	}

	public function getUserInterface($params = null) {
		include ('include/CMSPage.php');
		$this->smarty->assign('hasRestriction',$this->hasRestriction());
		$page = new CMSPage($_REQUEST ['page']);
		$rev = $page->getActiveRevisions($_SESSION ['lang']);
		if($page->getAccess() != 'public' && $this->hasRestriction()){
			$auth_container = new User();
			$auth = new Auth($auth_container, null, 'authInlineHTML');
			$auth->start();
			if (!$auth->checkAuth()) {
				return authInlineHTML();
			} else if($page->getAccess() != 'public' && $_SESSION['authenticated_user']->hasPerm('membersaccess')){
				$this->smarty->assign ('content_perms', true);
			} else {
				$this->smarty->assign ('content_perms', false);
			}
		} else {
			$this->smarty->assign('content_perms', true);
		}
		$metaData = $rev->getMetaData();
		$this->smarty->assign ( 'content', $rev );
		$this->setMetaDescription($metaData['description']);
		$this->setMetaTitle($metaData['title']);
		$this->setMetaKeywords($metaData['keywords']);
		$this->setPageTitle($rev->getPageTitle());
		return $this->smarty->fetch ( 'db:content.tpl' );
	}

	protected function topLevelInterface() {
		if ($this->user->hasPerm ( 'viewcontentadmin' )) {
			$pages = CMSPage::getContentPages();
			$this->smarty->assign ( 'pages', $pages );
			$this->template = 'admin/content.tpl';
		}
	}

	protected function viewLayers($id) {
		$this->smarty->assign ( 'parent_id', $_REQUEST ['id'] );
		$this->template = 'admin/content_layers.tpl';
	}

	public function toggleStatus($id) {
		$status = $this->db->query_fetch ( 'select status, parent_id, locale_id from content_page_data where id=' . $id );
		$sql = 'update content_page_data set status=0 where parent_id=' . $status ['parent_id'] . ' and locale_id=' . $status ['locale_id'];
		$this->db->query ( $sql );
		if ($status ['status'] == 1) {
			$status = 0;
		} else {
			$status = 1;
		}
		$sql = 'update content_page_data set status=' . $status . ' where id=' . $id;
		$this->db->query ( $sql );
		$this->template = 'admin/content.tpl';
	}

	protected function createRev($id) {
		if ($this->user->hasPerm ( 'editcontent' )) {
			
			$rev = new CMSPageRevision($id);
			$newRev = $rev->createRevision();
			
			/*
			$sql = 'insert into content_page_data (parent_id, content, status, page_title, locale_id) (select parent_id, content, status, page_title, locale_id from content_page_data where id=' . $id . ')';
			$this->db->query ( $sql );
			$newRevID = $this->db->lastInsertedID ();
			$sql = 'update content_page_data set status=0 where id=' . $newRevID;
			$this->db->query ( $sql );
			$sql = 'select content_page_data.*, l.id as lid, l.display_name from content_page_data, `locale` l WHERE content_page_data.id=' . $newRevID . ' AND l.id=content_page_data.locale_id';
			$newRev = $this->db->query_fetch ( $sql );
			*/
			$form = $newRev->getAddEditForm ( );
			
			//$renderer = new HTML_QuickForm_Renderer_ArraySmarty ( $this->smarty );
			//$form->accept ( $renderer );
			
			$this->smarty->assign ( 'form', $form );
			$this->smarty->assign ( 'page', $newRev );
			$this->template = 'admin/content_addedit.tpl';
		}
	}

	protected function updateRev() {
		$rev = new CMSPageRevision($_REQUEST ['id']);
		$form = $rev->getAddEditForm();

		if (isset ( $_REQUEST ['submit'] )) {
			$this->setActiveRev ( $_REQUEST ['id'] );
		}
	}

	public function setActiveRev($id) {
		$sql = 'select * from content_page_data where id=' . $id;
		$result = $this->db->query_fetch ( $sql );
		$sql = 'update content_page_data set status=0 where parent_id=' . $result ['parent_id'] . ' and locale_id=' . $result ['locale_id'];
		$this->db->query ( $sql );
		$sql = 'update content_page_data set status=1 where id=' . $id;
		$this->db->query ( $sql );
	}

	protected function startWizard($step = 1) {
		$this->template = 'admin/create_page_wizard.tpl';
		
		$this->smarty->assign('step', $step);
		
		switch ($step) {
			case 1:
				$page = new CMSPage();
				$form = $page->getForm();
				$form->addRule('urlkey', 'Key already used', new validCKey(), null);
				$form->removeElement ( 'section' );
				$form->removeElement ( 'action' );
				$form->_constantValues = array ( );
				
				$form->addElement ( 'hidden', 'section' );
				$defaultValues ['section'] = 'wizard';
				
				$form->addElement ( 'hidden', 'wizardStep' );
				$defaultValues ['wizardStep'] = $step;
				
				$form->setDefaults ( $defaultValues );
				
				$this->smarty->assign('form', $form);
				break;
			case 2:
				$page = new CMSPage();
				$page->setStatus(true);
				$page->setAccess('public');
				$form = $page->getForm();
				
				$_SESSION['wizard_page_id'] = $page->getId();
				
				$this->addJS('/modules/Content/js/admin.js');
				require_once ('include/ContentTemplate.php');
				$templates = ContentTemplate::getAllContentTemplates();
				$this->smarty->assign('templates', $templates);
				$this->template = 'admin/content_templates.tpl';
				//return $this->smarty->fetch('admin/content_templates.tpl');
				break;
			case 3:
				require_once ('include/ContentTemplate.php');
				
				$layer = new CMSPageRevision();
				
				$template = new ContentTemplate($_REQUEST['template_id']);
				$layer->setContent($template->getContent());
				
				$layer->setParentId($_SESSION['wizard_page_id']);
				$form = $layer->getAddEditForm();
				
				$form->removeElement ( 'section' );
				$form->removeElement ( 'action' );
				$form->_constantValues = array ( );
				
				$form->addElement ( 'hidden', 'section' );
				$defaultValues ['section'] = 'wizard';
				$form->addElement ( 'hidden', 'parent_id' );
				$defaultValues ['parent_id'] = $_SESSION['wizard_page_id'];
				
				$form->addElement ( 'hidden', 'wizardStep' );
				$defaultValues ['wizardStep'] = $step;
				$form->setConstants ( array ('wizardStep' => $step ) );
				
				$defaultValues ['language'] = 1;
				
				$form->setDefaults ( $defaultValues );
				
				$this->smarty->assign('form', $form);
				break;
			case 4:
				$layer = new CMSPageRevision();
				$layer->setParentId($_REQUEST['parent_id']);
				$form = $layer->getAddEditForm();
				
				$this->topLevelInterface();
		}
	}

	public function contentForm($newRev = null) {
		$form = new Form ( 'page_addedit', 'POST', '/admin/Content', '', array ('class' => 'admin' ) );
		$form->addElement ( 'text', 'title', 'Page Title', array ('value' => $newRev->getPageTitle() ) );
		
		$sql = 'select * from locale order by display_name';
		$rows = $this->db->query_fetch_all ( $sql );
		$languages = array ( );
		foreach ( $rows as $language ) {
			$languages [$language ['id']] = $language ['display_name'];
		}
		
		$form->addElement ( 'select', 'language', 'Language', $languages );
		$form->addElement ( 'text', 'access', 'Page Access' );
		$defaultValues ['language'] = array ($newRev->getLocaleId() );
		$defaultValues ['access'] = $newRev->getAccess();
		$form->setDefaults ( $defaultValues );
		
		$form->setConstants ( array ('action' => 'updatePage', 'id' => $newRev->getId(), 'section' => 'addEdit' ) );
		$form->addElement ( 'hidden', 'id' );
		$form->addElement ( 'hidden', 'section' );
		$form->addElement ( 'hidden', 'action' );
		
		$oQFElement = HTML_Quickform::createElement ( 'tinymce', 'editor', 'Content' );
		//$oQFElement->setFCKProps ( '/core/fckeditor/', 'Default', '100%', '500', array ('SkinPath' => 'editor/skins/office2003/', 'DefaultLanguage' => 'en', 'StylesXmlPath' => '/core/fckeditor/fckstyles.xml', 'UseBROnCarriageReturn' => 'true', 'StartupFocus' => 'false', 
		//		'CustomConfigurationsPath' => 'config.js', 'EditorAreaCSS' => 'fck_editorarea.css' ) );
		$oQFElement->setValue ( $newRev->getContent() );
		$form->addElement ( $oQFElement );
		
		$form->addElement ( 'submit', 'submit', 'Save and auto-publish', array ('id' => 'submit' ) );
		$form->addElement ( 'submit', 'submit_leavestatus', 'Save (but don\'t publish)' );
		
		$form->applyFilter ( 'urlkey', 'title' );
		$form->addRule ( 'title', 'Please enter a Page Title', 'required', null, 'client' );
		$form->addRule ( 'editor', 'Please enter some Page Content', 'required', null, 'client' );
		
		return $form;
	}

	public function deleteRev($id) {
		$sql = 'delete from content_page_data where id=' . $id;
		$this->db->query ( $sql );
	}

	public static function hasRestriction(){
		$opts = Config::getModuleOptions('Content');
		if(@$opts['restrictedpages']){
			return true;
		} else {
			return false;
		}
	}
	
	public static function linkHandler($id) {
		$sql = 'select page_name from content_pages where id=' . $id;
		$page = Database::singleton ()->query_fetch ( $sql );
		return '/Content/' . $page ['page_name'];
	}

	public static function linkType() {
		return 'Content Page';
	}

	public static function getValidLinks() {
		$sql = 'select id as `key`, page_name as value from content_pages where status=1';
		$pages = Database::singleton ()->query_fetch_all ( $sql );
		return $pages;
	}
	
	public function &getSoapInterface(&$server, $ns) {
		$server->register('Module_Content.linkType',                // method name
		    array(),        // input parameters
		    array('return' => 'xsd:string'),      // output parameters
		    $ns);
		return $server;
	}
	
	public function getMetaEditor($id){
		$pageR = new CMSPageRevision($id);
		$page = new CMSPage($pageR->getParentId());
		$form = $page->getForm();
		
		
				$form->removeElement ( 'section' );
				$form->removeElement ( 'action' );
				$form->removeElement ( 'id' );
				$form->_constantValues = array ( );
				$form->addElement ( 'hidden', 'section' );
				$defaultValues ['section'] = 'addEdit';
				$form->addElement ( 'hidden', 'action' );
				$defaultValues ['action'] = 'editMeta';
				$form->addElement ( 'hidden', 'id' );
				$defaultValues ['id'] = $pageR->getId();
		
		$metadata = $pageR->getMetaData();
		$defaultValues['metatitle'] = $metadata['title'];
		$defaultValues['metadesc'] = $metadata['description'];
		$defaultValues['metakeywords'] = $metadata['keywords'];
		$defaultValues['urlkey'] = $page->getPageName();
		$form->setDefaults($defaultValues);
		$this->smarty->assign('form', $form);
		
		if ($form->validate() && (isset($_REQUEST['submit']))){
			$metadata = array('title'=>$form->exportValue('metatitle'),'description'=>$form->exportValue('metadesc'),'keywords'=>$form->exportValue('metakeywords'));
			$pageR->setMetaData($metadata);
			$pageR->save();
			$this->topLevelInterface();
		}
	}

}

require_once 'HTML/QuickForm/Rule.php';
class validCKey extends HTML_QuickForm_Rule {
	function validate($value) {
		$sql = 'select `page_name` from content_pages where `page_name` = "'.e($value).'"';
		$result = DataBase::singleton()->query_fetch($sql);
		if($result) {
			return false;
		} 
		return true;
	}
}
