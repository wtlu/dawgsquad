<!-- File:app/tests/cases/controllers/loans_controller.test.php -->
<!--
	Created: 5/12/2011
	Author: Jedidiah Jonathan

	Changelog:
        5/12/2011 - Jedidiah Jonathan- Created file (empty)
        5/19/2011 - Jedidiah Jonathan- Updated to just test the functions of loan controller
	5/20/2011 - Jedidiah Jonathan- Testing complete on the Loan controller
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


  /* Testing the functionality of the my_loans function */
  function testmy_loans() {

    $result = $this->testAction('/loans/my_loans/',array('return' => 'vars'));
    debug($result);
    
    // Assert that results obtained from my books has the appropriate data values
    // Cannot access the uid from the test here as it is currently being implemented using the Session. 
    // Therefore all these results will be NULL. 
    $this->assertEqual($result['loan_collection'][0]['loans']['client_id'], NULL);
    $this->assertEqual($result['book_collection'], NULL);

    // Assert the tile for the layout has the correct field
    $this->assertEqual($result['title_for_layout'], 'Library || My Loans');

  }

  /* Testing the functionality of the complete_loan function */
  function testcomplete_loan() {

    $result = $this->testAction('/loans/complete_loan/',array('return' => 'vars'));
    debug($result);

    // Assert that results obtained from my books has the appropriate data values
    // Cannot access the uid from the test here as it is currently being implemented using the Session. 
    // Therefore all these results will be NULL.
    $this->assertEqual($result['due_date'], NULL);
    $this->assertEqual($result['client_name'], NULL);
    $this->assertEqual($result['book_info'], NULL);

    // Assert the tile for the layout has the correct field
    $this->assertEqual($result['title_for_layout'], 'Library || My Loans');

  }
  
  /* Testing the functionality of the remove_loan function */
  function testremove_loan() {

    $result = $this->testAction('/loans/remove_loan/',array('return' => 'vars'));
    debug($result);

    // Assert the tile for the layout has the correct field
    $this->assertEqual($result['title_for_layout'], 'Library || My Loans');

  }
}

?>
