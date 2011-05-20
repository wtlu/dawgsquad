<!-- File:app/tests/cases/controllers/loans_controller.test.php -->
<!--
	Created: 5/12/2011
	Author: Jedidiah Jonathan

	Changelog:
        5/12/2011 - Jedidiah Jonathan- Created file (empty)
-->
<?php
        App::import('Controller','Loans');
	App::import('Model', 'Loan');
       	App::import('Model', 'User');

class LoansControllerTest extends CakeTestCase {

  var $fixtures = array('app.loan');
  var $helpers = array('Session');

  function startCase() {
    echo '<h1>Starting Test Case</h1>';
  }
  
  function endCase() {
    echo '<h1>Ending Test Case</h1>';
  }

  function startTest($method) {
    echo '<h3>Starting method ' . $method . '</h3>';
  }

  function endTest($method) {
    echo '<hr />';
  }

  //Add Test functions as necessary

  function testmy_loans() {

    $result = $this->testAction('/loans/my_loans/',array('return' => 'vars'));
    debug($result);
  }
  
  function testcomplete_loan() {

    $result = $this->testAction('/loans/complete_loan/',array('return' => 'vars'));
    debug($result);
  }
  
  function testremove_loan() {

    $result = $this->testAction('/loans/remove_loan/',array('return' => 'vars'));
    debug($result);
  }
}

?>
