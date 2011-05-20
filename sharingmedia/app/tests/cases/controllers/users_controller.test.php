<!--
File: /app/tests/cases/users_controller.test.php

	Created: 5/13/2011
	Edited: 5/19/2011 took the cause of redirecting
	Author: Tatsuro Oya

	
-->
<?php
	
	/*import controller*/
	App::import('Controller','Users');
 
	/* UserControllerTest here */
	class UsersControllerTest extends CakeTestCase{
		
		var $fixtures = array( 'app.user', 'app.book', 'app.book_initial_offer', 'app.transaction' );
		var $helpers = array ('HTML', 'Form', 'Session', 'Facebook.Facebook');


		function startCase() {
			/*executed before running case*/
			echo '<h1>Starting Test Case</h1>';
		}
		  
		function endCase() {
			/*executed after running case*/
			echo '<h1>Ending Test Case</h1>';
		}

		function startTest($method) {
			/*executed before method*/
			echo '<h3>Starting method ' . $method . '</h3>';
		}

		function endTest($method) {
			/*executed after method*/
			echo '<hr />';
		}

		/* functions above checks if initiated correctly or not. 
		 * the test functions starts from here
		 */

		 
		/*Test 1: Examines Data used in controller
		 *  this test checks if the record to be retreived by this controller exists 
		 *  and checks if it displays expected record
		 *  
		 *  read User's id =1's contents
		 *  compare with the expected value (we know the dummy var)
		 *  
		 */
		 // function testFindData(){
			// /*read User's id = 1 then store it to the res1 */
			// $this->Users->User->id = 1;
			// $res1 = $this->Users->User->read();
			// debug($res1);
			// /* compare with the expected (dummy var) that we prepared */
			// $this ->assertNotNull($res1['User']);
			// $this ->assertEqual($res1['User']['id'], 1);
			// $this ->assertEqual($res1['User']['name'], 'Wei-Ting Lu');
			// $this ->assertEqual($res1['User']['password'], null);
			// $this ->assertEqual($res1['User']['facebook_id'], '518118311');
			// $this ->assertEqual($res1['User']['created'], NOW());
			
		 // }
		    
		
		
		/* Test2:  examine each Action function ( actoin is the view )
		 *
		 * get the result of "action" then examines it.
		 *
		 * 2 important thing:
		 * array('return' => 'render') is rendering results ( what to be displayed)
		 * array('return' => 'vars') is the data to be passed to the views  (nothing to be passed in this controller so ignore this)
		 *
		 * Quick Example: examines vars to see if the controller are passing expected data to the view
		 * $var = $this->testAction('actionpath', 'return value');
		 *  
		 */	
	
		/* Test2: Action function check
		 *        for each action we check whether each function is rendering appropriate page 
		 *        to do this we check page title and layout to see each function is choosing approproate ones 
		 *		  This can be done by parsing the 1. page title and 2. css 
		
		function testIndex() {
		
			debug('conducting render check for index() action method ');
			$result = $this->testAction('/Users/index', array('return' => 'render'));
			
			$this->assertPattern("/<title>Sharing Media<\/title>/", $result);  
			$this->assertPattern("/<link rel=\"stylesheet\" type=\"text\/css\" href=\"\/sharingmedia\/app\/webroot\/css\/main.css\" \/>/", $result);
		}
		 
		 */
		
		
		function testLogin() {
		
			debug('conducting render check for login() action method ');
			$result = $this->testAction('/Users/login/1', array('return' => 'vars'));
			
			debug($result);
		
		}
		
		
		

		
		
	


		
	
	}	
?>