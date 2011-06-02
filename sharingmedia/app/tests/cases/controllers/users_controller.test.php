<!--
    File: /app/tests/cases/users_controller.test.php

Created: 5/13/2011
Edited: 5/19/2011 took the cause of redirecting
Author: Tatsuro Oya


-->
<?php

/*import controller*/
App::import('Controller','Users');
App::import('Model','User');

class TestUsersController extends UsersController {

  var $name = 'Users';
  
  var $autoRender = false;
  
  function redirect($url, $status = null, $exit = true) {
    $this->redirectUrl = $url;
  }
  
  function render($action = null, $layout = null, $file = null) {
    $this->renderedAction = $action;
  }
  
  function _stop($status = 0) {
    $this->stopped = $status;
  }

}





/* UserControllerTest here */
class UsersControllerTest extends CakeTestCase{
  
  var $fixtures = array( 'app.user', 'app.book', 'app.book_initial_offer', 'app.transaction', 'app.loan' );
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
    $this->Users = new TestUsersController();
    $this->Users->constructClasses();
    $this->Users->Component->initialize($this->Users);		
    
  }
  
  
  

  function endTest($method) {
    /*executed after method*/
    echo '<hr />';
    $this->Users->Session->destroy();
    unset($this->Users);
    ClassRegistry::flush();
  }

  /* Explanation for why the test code is not written in this unit test.
	 *   The function has to use $session = $facebook->getSession()  to get session from facebook and 
	 * 	 We cannot test because there is not a way to set the local variable $session from the controller.
	 *   
	 *
	 *
	 */
  
  
  
  function testIndex(){
    debug('The User Controller will not be tested because the only functionality it provides is a wrapper around the Facebook login system. For security reasons, Facebook disallows scripting logging in. ');
    
  }

}	
?>