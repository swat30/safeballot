<?php

class Module_Blocks extends Module {
	
	/**
	 * Build and return admin interface
	 * 
	 * Any module providing an admin interface is required to have this function, which
	 * returns a string containing the (x)html of it's admin interface.
	 * @return string
	 */
	function getAdminInterface() {
		
		switch (@$_REQUEST['section']) {
			case 'toggle':
				$block = new Block($_REQUEST['id']);
				if ($block->getStatus() == 'active') {
					$block->setStatus('inactive');
					$block->save();
				} else {
					$block->setStatus('active');
					$block->save();
				}
				return $this->topLevelAdmin();
				break;
			case 'addedit':
				$block = new Block(@$_REQUEST['blocks_id']);
				$form = $block->getAddEditForm();
				
				if ($form->validate() && $form->isSubmitted() && isset($_REQUEST['blocks_submit'])) {
					return $this->topLevelAdmin();
				} else {
					return $block->getAddEditForm()->display();
				}
				break;
			case 'delete':
				$block = new Block(@$_REQUEST['blocks_id']);
				$block->delete();
				return $this->topLevelAdmin();
				break;
			default:
				return $this->topLevelAdmin();
		}
	}
	
	function getUserInterface($params) {
		include_once ('include/Block.php');
		$b = Block::getAllBlockss('active');
		
		$this->smarty->assign('blocks', $b);
		return $this->smarty->fetch('blocks.tpl');
	}
	
	function topLevelAdmin() {
		$this->addJS('/modules/Blocks/js/admin.js');
		$b = Block::getAllBlockss();
		$this->smarty->assign('blocks', $b);
		
		return $this->smarty->fetch( 'admin/blocksoverview.tpl' );
	}

}

?>