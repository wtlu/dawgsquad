<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @link http://book.cakephp.org/view/957/The-App-Controller
 */
class AppController extends Controller {
  	var $helpers = array('Html', 'Form', 'Session', 'Facebook.Facebook');
	var $components = array('Session',
//		'Auth' => array( 
//		'authorize' => 'controller',
//		'authorizedActions' => array('index', 'view', 'display')
//		),
	'Facebook.Connect');
	
	function beforeFilter() {
//		$this->set('user', $this->Auth->user());
//		$this->set('facebook_user', $this->Connect->user());
		
		
		//The session might linger from a recent logout, check for this
	
		$this->Session->write('uid', $this->Connect->user('id'));
		
		
		
//		$this->Session->write('username', $this->Connect->user('name'));	
	}
	
//	function isAuthorized(){
//		return($this->Auth->user('id'));	
//	}
}
