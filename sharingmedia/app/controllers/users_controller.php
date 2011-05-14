<?php

class UsersController extends AppController {
	var $helpers = array ('HTML', 'Form', 'Session', 'Facebook.Facebook');
	var $name = 'Users';
	
	
	
	function index() {
		$this->layout = 'index_layout';
		$this->set('title_for_layout', 'Sharing Media');
		
		
		$facebook = new Facebook(array(
		'appId'  => '218244414868504',
		'secret' => 'fb83c155cc38febb1fb9024c1a9eb050',
		'cookie' => true,
		'domain' => 'http://ec2-50-18-34-181.us-west-1.compute.amazonaws.com/dawgsquad/sharingmedia/'
		));
		
		//If the user is logged in...
		
		
		$session = $facebook->getSession();
 		if ($session){
		
			// User is logged in and authorized, let's party.
			// Get user information of current user
			$user = $facebook->getUser();
			
			print "Welcome User ID: " . $user;
	
		} else {

			// User has not authorized us or is not logged in
			// For a full list of permissions please see http://developers.facebook.com/docs/authentication/permissions

			//echo '<fb:redirect url="' . $redirect . '">';
			
			$params = array(
				'fbconnect'=>0,
				'canvas'=>1,
				'next'=>"http://apps.facebook.com/sharingmedia/index.php/",
				'req_perms'=>''
			);
			
			$redirect_url = $facebook->getLoginUrl($params);
			//echo '<fb:redirect url="' . $redirect_url . '">';
			//echo '<a href="' . $redirect_url . '">Login</a>';
			
			$this->redirect($redirect_url);			
			
			//echo $this->redirect(array('controller'=>'users','action' => 'login'));
		}
		
		//$this->Facebook->getLoginStatusUrl("http://apps.facebook.com/sharingmedia/", "http://apps.facebook.com/sharingmedia/users/login/", "http://apps.facebook.com/sharingmedia/users/login/");
		//if (!$facebook->getSession()){
		//	echo $this->redirect(array('controller'=>'users','action' => 'login'));	
		//}
//		$this->set('users', $this->User->find('all'));	
	}
	

	function home(){
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Sharing Media');
	}
	
	function comming_soon(){
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Comming Soon');
	}
	
	function login(){
/*		$this->redirect('https://www.facebook.com/dialog/oauth?client_id=218244414868504&redirect_uri=http://apps.facebook.com/sharingmedia/');*/

		$this->layout = 'login_layout';
		$this->set('title_for_layout', 'Login');
		
		$facebook = new Facebook(array(
		'appId'  => '218244414868504',
		'secret' => 'fb83c155cc38febb1fb9024c1a9eb050',
		'cookie' => true
		));
		
		/*
		echo "before logic";
		echo print_r($facebook_user);
		echo $this->Session->read('uid');
		if($facebook->getSession()){
			echo "in loop";
			$user_id = $this->Session->read('uid');		
			$count = $this->User->query('SELECT COUNT(*) FROM users WHERE facebook_id ="' . $user_id . '";');
			print_r($count);
			if($count == 0){
				echo "count == 0";
				$this->User->query('INSERT INTO users(facebook_id) VALUES("' . $user_id . '";');	
				$this->redirect('https://www.facebook.com/dialog/oauth?client_id=218244414868504&redirect_uri=http://ec2-50-18-34-181.us-west-1.compute.amazonaws.com/dawgsquad/sharingmedia/');	
			} else {
				echo "trying to redirect";
				echo $this->redirect(array('controller'=>'users','action' => 'index'));
			}
		}
		
*/	
	
		echo '<h2>Session was not found. Please ';
		
		$facebook = new Facebook(array(
		'appId'  => '218244414868504',
		'secret' => 'fb83c155cc38febb1fb9024c1a9eb050',
		'cookie' => true
		));
		
		
		$params = array(
				'fbconnect'=>0,
				'canvas'=>1,
				'next'=>"http://apps.facebook.com/sharingmedia/index.php/",
				'req_perms'=>''
			);
			
		$redirect_url = $facebook->getLoginUrl($params);
			
		echo '<a href="' . $redirect_url . '">Login</a>';
		
		echo '</h2>';
	
		//This sends app into  infinite loop
		//$this->redirect($redirect_url);
		
		
		//echo '<fb:redirect url="' . $redirect_url . '">';
		
//		if($this->Session->check('uid')){
//			echo $this->redirect(array('controller'=>'users','action' => 'index'));
//		} else if( {
		//	$this->redirect('https://www.facebook.com/dialog/oauth?client_id=218244414868504&redirect_uri=http://localhost/sharingmedia/');	
		//}*/
	}
	
	function logout(){
//		$this->Auth->logout();
//		$this->Session->destroy();
//		$this->redirect('/');	
	}
/*	
	function login(){
		//import facebook sdk
		App::import('Vendor', 'facebook');
		$facebook=new Facebook(array(
		'appId'=>'218244414868504',
		'secret'=>'fb83c155cc38febb1fb9024c1a9eb050',
		'cookie'=>true
		));
		
		#generate facebook session
		$session=$facebook->getSession();
		# generate login url
		     		$login_url = $facebook->getLoginUrl(array(
		'next' => 'http://localhost/fboauth/users/callback',
		));
		#if session available
		if(!empty($session)){
			$this->Session->write('uid',$session['uid']);
//			print_r($session);
//			$this->Session->write('username',$session['name']);
			$this->redirect(array('controller'=>'users','action'=>'index'),null,true);
		}else{
			$this->redirect($login_url);
		}
	}


	
	function logout(){
		$this->Session->destroy();
		$this->Session->setFlash('You have successfully logged out.');
		$this->redirect(array('controller'=>'users','action' => 'home'));
	}

	
	function callback(){
		App::import('Vendor', 'facebook');
		
		$facebook=new Facebook(array(
		'appId'=>'218244414868504',
		'secret'=>'fb83c155cc38febb1fb9024c1a9eb050',
		'cookie'=>true
		));
		$session=$facebook->getSession();
		if(!empty($session)){
			try{
				$user=json_decode(file_get_contents('https://graph.facebook.com/me?access_token'.$session['access_token']));
			}catch(FacebookApiException $e){
				error_log($e);
			}
		if(!empty($user)){
			//check user on users table by oauth_uid
			$user_id=$this->User->findByOauthUid($user->id);
			//if empty/ ser not found then insert into table
			if(empty($user_id)){
				$this->data['User']['oauth_provider']='facebook';
				$this->data['User']['oauth_uid']=$user->id;
				$this->data['User']['access_token']=$session['access_token'];
				$this->data['User']['username']=$user->name;
					if($this->User->save($this->data)){
						$this->Session->write('uid',$user->id);
						$this->Session->write('access_token',$session['access_token']);
						$this->Session->write('username',$user->name);
						$this->Session->setFlash(__('Your profile has been saved', true));
						$this->redirect(array('controller'=>'users','action'=>'index'));
					}else{
						$this->Session->setFlash(__('Sorry, we could not save your profile. Please, try again.', true));
						$this->redirect(array('controller'=>'users','action'=>'home'),null,true);
					}
				}else{
					$this->Session->write('uid',$user_id['User']['oauth_uid']);
					$this->Session->write('acces_token',$user_id['User']['access_token']);
					$this->Session->write('username',$user_id['User']['username']);
					$this->redirect(array('controller'=>'users','action'=>'index'),null,true);
				}
			}
		}else{
			$this->Session->setFlash(__('Sorry, we could not authenticate you.', true));
			$this->redirect(array('controller'=>'users','action'=>'home'),null,true);
		}
	}
*/

}
?>