<?php
class UsersController extends AppController {
	var $helpers = array ('HTML', 'Form');
	var $name = 'Users';
	
	//define('FACEBOOK_APP_ID', '218244414868504');
	//define('FACEBOOK_SECRET', 'fb83c155cc38febb1fb9024c1a9eb050');
/*	
	function get_facebook_cookie($app_id, $application_secret) {
  		$args = array();
		parse_str(trim($_COOKIE['fbs_' . $app_id], '"'), $args);
		ksort($args);
		$payload = '';
		foreach ($args as $key => $value) {
	  		if ($key != 'sig') {
	    		$payload .= $key . '=' . $value;
	  		}
		}
		if (md5($payload . $application_secret) != $args['sig']) {
			return null;
		}
		return $args;
	}
*/	
//	var $cookie = 'hello';
//	var $cookie = get_facebook_cookie(218244414868504, fb83c155cc38febb1fb9024c1a9eb050);
	
	function index() {
		$this->set('users', $this->User->find('all'));	
	}

}
?>