<?php

class UsersController extends AppController {
	var $helpers = array ('HTML', 'Form', 'Session', 'Facebook.Facebook');
	var $name = 'Users';
	
	
	
	function index() {

		$user_id = $this->Session->read('uid');
		$user_name = $this->Session->read('username');
		$count = $this->User->query('SELECT COUNT(*) FROM users WHERE facebook_id ="' . $user_id . '";');
		$count_num = $count[0][0]['COUNT(*)'];
		if($count_num == 0){
			$this->User->query('INSERT INTO users(name, password, facebook_id, created) VALUES("' . $user_name . '", null, "' . $user_id . '", NOW());');
		}
		$this->layout = 'index_layout';
		$this->set('title_for_layout', 'Sharing Media');
		
		if(!$this->Session->check('uid')){
			echo $this->redirect(array('controller'=>'users','action' => 'example'));
		}
	}
	
	
	function login(){
		if($this->Session->check('uid')){
			echo $this->redirect(array('controller'=>'users','action' => 'index'));
		}
		
		$this->layout = 'login_layout';
		$this->set('title_for_layout', 'Login');
		App::import('Vendor', 'facebook');

		$facebook = new Facebook(array(
  			'appId'  => '218244414868504',
  			'secret' => 'fb83c155cc38febb1fb9024c1a9eb050',
  			'cookie' => true,
		));

		$session = $facebook->getSession();
		$loginUrl=$facebook->getLoginUrl(array(
			'canvas'=>1,
			'fbconnect'=>0,
			'display'=>'page',
			'next'=>'http://apps.facebook.com/sharingmedia/',
			'cancel_url'=>'http://www.facebook.com/'
		));
		$me = null;
		if ($session) {
	  		try {
	    		$uid = $facebook->getUser();
	    		$me = $facebook->api('/me');
	
//	    		echo "Welcome User: " . $me['name'] . "<br />";
	  		} catch (FacebookApiException $e) {
	    		error_log($e);
	  		}
		} else {
    		echo("<script> top.location.href='" . $loginUrl . "'</script>");	
		}

	}
	
	function home(){
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Sharing Media');
	}
	
	function comming_soon(){
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Comming Soon');
	}

}
?>