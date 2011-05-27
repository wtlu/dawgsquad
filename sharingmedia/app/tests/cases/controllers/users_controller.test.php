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

	
		function testImpossible(){
			debug('The User Controller will not be tested because the only functionality it provides is a wrapper around the Facebook login system. For security reasons, Facebook disallows scripting logging in. ');
		}	
		
		
		

		
		
	


		
	
	}	
?>