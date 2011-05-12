<?php
class UsersController extends AppController {
	var $helpers = array ('HTML', 'Form');
	var $name = 'Users';
	
	function index() {
		$this->layout = 'index_layout';
		$this->set('title_for_layout', 'Sharing Media');
		if(!$this->Session->check('uid')){
			echo $this->redirect(array('controller'=>'users','action' => 'login'));	
		}
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
		$this->layout = 'login_layout';
		$this->set('title_for_layout', 'Login');
		if($this->Session->check('uid')){
			echo $this->redirect(array('controller'=>'users','action' => 'index'));
		}
	}
	
	function logout(){
//		$this->Auth->logout();
		$this->Session->destroy();
		$this->redirect('/');	
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