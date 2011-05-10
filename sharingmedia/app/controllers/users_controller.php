<?php
class UsersController extends AppController {
	var $helpers = array ('HTML', 'Form');
	var $name = 'Users';
	
	function index() {
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Front Page Bitches');
		$this->set('users', $this->User->find('all'));	
	}

}
?>