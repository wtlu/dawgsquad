<?php
/*
	Created: 5/3/2011
	Author: Troy Martin

	This controller handles user login and authentication
*/
class UsersController extends AppController {
	var $helpers = array ('HTML', 'Form', 'Session', 'Facebook.Facebook');
	var $name = 'Users';
	
	
/*
	Pre: Called to display the splash page index.ctp. A user must be logged in otherwise the page is redirected to login.ctp.
	Post: If a user is new to the app, the user will be added to the users table.
		The user will see the index page displaying a personal welcome message.
*/	
	function index() {
		// get the user id and name to see if they are in the users table
		$user_id = $this->Session->read('uid');
		$user_name = $this->Session->read('username');
			
		// query the table to see if the user is in the table
		$count = $this->User->query('SELECT COUNT(*) FROM users WHERE facebook_id ="' . $user_id . '";');
		$count_num = $count[0][0]['COUNT(*)'];
		
		//if they aren't in the table, add them
		if($count_num == 0){
			$this->User->query('INSERT INTO users(name, password, facebook_id, created) VALUES("' . $user_name . '", null, "' . $user_id . '", NOW());');
		}
		
		// display the correct layout
		$this->layout = 'index_layout';
		$this->set('title_for_layout', 'Sharing Media');
		
		// check to see if the user is logged out, if so, redirect to login
		if(!$this->Session->check('uid')){
			echo $this->redirect(array('controller'=>'users','action' => 'login'));
		}
	}
	
	function index2(){
		//$user_id = $this->Session->read('uid');
		//$user_name = $this->Session->read('username');
		//debug printing
		//$temp = $this->Session->read('friendsLists');
		//debug($temp);
/*		foreach ($friendsLists as $friends) {
			debug("in foreach");
	    	foreach ($friends as $friend) {
	         // do something with the friend, but you only have id and name
	       		$id = $friend['id'];
	        	$name = $friend['name'];
	        	debug($id);
	      	}
	   }
*/		
		// display the correct layout
		$this->layout = 'index_layout';
		$this->set('title_for_layout', 'Sharing Media');
		
		$facebook = new Facebook(array(
  			'appId'  => '218244414868504',
  			'secret' => 'fb83c155cc38febb1fb9024c1a9eb050',
  			'cookie' => true,
		));

		// initialize new session, get login url
		$session = $facebook->getSession();
		$loginUrl=$facebook->getLoginUrl(array(
			'canvas'=>1,
			'fbconnect'=>0,
			'display'=>'page',
			'next'=>'http://apps.facebook.com/sharingmedia/',
			'cancel_url'=>'http://www.facebook.com/'
		));
		$me = null;
		// test if we have a session, otherwise, redirect to login url, which handles asking the user for permission to their info when adding the app 
		if ($session) {
	  		try {
	    		$uid = $facebook->getUser();
	    		$me = $facebook->api('/me');
	    		$user_id = $me['id'];
	    		$user_name = $me['name'];
	    		//debug($me);
	    		$friendsLists = $facebook->api('/me/friends');
	    		//debug($friendsLists);
	    		//$this->Session->write('friendsLists', $friendsLists["data"]);
	    		//$temp = $this->Session->read('friendsLists');
	    		//debug($temp);
				$friendsArray = array();
				$i = 0;
			    foreach ($friendsLists as $friends) {
			      foreach ($friends as $friend) {
			         // do something with the friend, but you only have id and name
			         $id = $friend['id'];
			         $friendsArray[$i] = $id;
			         $i++;
			         //$name = $friend['name'];
			      }
			   	}
		   		$this->Session->write('friends', $friendsArray);
		   		debug($this-Session-read('friends'));
			   // query the table to see if the user is in the table
				$count = $this->User->query('SELECT COUNT(*) FROM users WHERE facebook_id ="' . $user_id . '";');
				$count_num = $count[0][0]['COUNT(*)'];
				
				//if they aren't in the table, add them
				if($count_num == 0){
					$this->User->query('INSERT INTO users(name, password, facebook_id, created) VALUES("' . $user_name . '", null, "' . $user_id . '", NOW());');
				}
	
//	    		echo "Welcome User: " . $me['name'] . "<br />";
	  		} catch (FacebookApiException $e) {
	    		error_log($e);
	  		}
		} else {
    		echo("<script> top.location.href='" . $loginUrl . "'</script>");	
		}

		
		
		// check to see if the user is logged out, if so, redirect to login
		if(!$this->Session->check('uid')){
			//debug("somethings wrong, trying to go back to login");
			echo $this->redirect(array('controller'=>'users','action' => 'index2'));
		}
	}
	
/*
	Pre: Called to display the login page login.ctp when a user hasn't logged into facebook yet.
	Post: The user will be redirected to the index page after they login.
		If they are new to the app, they will be asked to allow our app access to their facebook information.
*/	
	function login(){
		// if the session has an id, the user is logged in, redirect to index
		if($this->Session->check('uid')){
			echo $this->redirect(array('controller'=>'users','action' => 'index'));
		}
		
		// display proper layout
		$this->layout = 'login_layout';
		$this->set('title_for_layout', 'Login');
		App::import('Vendor', 'facebook');
		
		// initialize facebook object
		$facebook = new Facebook(array(
  			'appId'  => '218244414868504',
  			'secret' => 'fb83c155cc38febb1fb9024c1a9eb050',
  			'cookie' => true,
		));

		// initialize new session, get login url
		$session = $facebook->getSession();
		$loginUrl=$facebook->getLoginUrl(array(
			'canvas'=>1,
			'fbconnect'=>0,
			'display'=>'page',
			'next'=>'http://apps.facebook.com/sharingmedia/',
			'cancel_url'=>'http://www.facebook.com/'
		));
		$me = null;
		// test if we have a session, otherwise, redirect to login url, which handles asking the user for permission to their info when adding the app 
		if ($session) {
	  		try {
	    		$uid = $facebook->getUser();
	    		$me = $facebook->api('/me');
	    		//debug($me);
	    		$friendsLists = $facebook->api('/me/friends');
	    		//debug($friendsLists);
	    		$this->Session->write('friendsLists', $friendsLists["data"]);
	    		//$temp = $this->Session->read('friendsLists');
	    		//debug($temp);
/*				
			    foreach ($friendsLists as $friends) {
			      foreach ($friends as $friend) {
			         // do something with the friend, but you only have id and name
			         $id = $friend['id'];
			         $name = $friend['name'];
			      }
			   }
*/	
//	    		echo "Welcome User: " . $me['name'] . "<br />";
	  		} catch (FacebookApiException $e) {
	    		error_log($e);
	  		}
		} else {
    		echo("<script> top.location.href='" . $loginUrl . "'</script>");	
		}

	}

/*
	Pre: Called to display the coming soon page coming_soon.ctp.
	Post: The user will be redirected to the coming soon page.
*/		
	function coming_soon(){
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Coming Soon');
	}

}
?>