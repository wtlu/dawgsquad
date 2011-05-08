<?php
class UsersController extends AppController {
	var $helpers = array ('HTML', 'Form');
	var $name = 'Users';
	
	function index() {
		$this->set('users', $this->User->find('all'));	
	}
}
?>