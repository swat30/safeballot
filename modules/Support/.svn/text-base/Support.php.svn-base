<?php
define('MANTIS_USERID', 5);
define('MANTIS_USER', 'norexcms');
define('MANTIS_PASSWORD', '1qaz2wsx');
define('MANTIS_REALNAME', 'Christopher Troup');
define('MANTIS_EMAIL', 'chris@norex.ca');

class Module_Support extends Module {

	/**
	 * Build and return admin interface
	 *
	 * Any module providing an admin interface is required to have this function, which
	 * returns a string containing the (x)html of it's admin interface.
	 * @return string
	 */
	function getAdminInterface() {
		require_once('include/SupportTicket.php');

		$ticket = new SupportTicket();
		$form = $ticket->getAddEditForm();
		if ($form->validate()) {
			header('Location: /admin/Support');
			die();
		}

		switch (@$_REQUEST['section']) {
			case 'bug':
				$bugid = $_REQUEST['id'];
				$ticket = new SupportTicket($bugid);
				$soapdetails = $ticket->getSoapBugDetails();
				$this->smarty->assign('ticket', $soapdetails);
				return $this->smarty->fetch('admin/ticket.tpl');
				break;
			default:
				$tickets = SupportTicket::getUserSupportTickets();

				$this->smarty->assign('tickets', $tickets);
				$this->smarty->assign( 'form', $form );
				return $this->smarty->fetch( 'admin/support.tpl' );
		}
	}

	public function getUserInterface() {
		$form = $this->getSupportForm('/support/');

		$this->smarty->assign( 'form', $form );
		return $this->smarty->fetch( 'support.tpl' );
	}

}

?>