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
}

?>
