<?php
class CampaignRegister extends User{
	public function getRegisterForm($target = '/Vote/register'){
		$form = new Form ( 'group_register', 'POST', $target, '', array ('class' => 'admin' ) );
		
		$form->addElement('text', 'first_name', 'First Name');
		$form->addElement('text', 'last_name', 'Last Name');
		$form->addElement('text', 'company', 'Company/Group');
		$form->addElement('text', 'email', 'E-mail');
		$form->addElement('text', 'phone', 'Work Phone');
		$form->addElement('text', 'cell_phone', 'Cell Phone');
		$form->addElement('submit', 'register_submit', 'Submit');
		
		$form->addRule('first_name', 'Please enter your first name', 'required');
		$form->addRule('last_name', 'Please enter your last name', 'required');
		$form->addRule('company', 'Please enter your company/group', 'required');
		$form->addRule('email', 'Please enter your e-mail address', 'required');
		$form->addRule('email', 'Please enter a valid email address', 'email');
		$form->addRule('phone', 'Please enter your phone number', 'required');
		
		if($form->validate() && $form->isSubmitted() && isset($_REQUEST['register_submit'])){
			$body = "New registration request: \n\n";
			$body .= "Name: ".$form->exportValue('last_name').', '.$form->exportValue('first_name');
			$body .= "\nCompany/Group: ".$form->exportValue('company');
			$body .= "\nE-mail address: ".$form->exportValue('email');
			$body .= "\nPhone number(s): Work - ".$form->exportValue('phone').', Cell - '.$form->exportValue('cell_phone');
			$body .= "\n\nRequest sent on ".date("w F jS \a\\t g:ia");
			mail('jacob@norex.ca', 'Safeballot: New Request', $body);
		}
		
		return $form;
	}
}
?>