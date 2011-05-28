<?php
/* 
 * File:app/tests/cases/controllers/loans_controller.test.php -->
 * Created: 5/12/2011
 * Author: Jedidiah Jonathan

	Changelog:
        5/12/2011 - Jedidiah Jonathan- Created file (empty)
        5/19/2011 - Jedidiah Jonathan- Updated to just test the functions of loan controller
	5/20/2011 - Jedidiah Jonathan- Testing complete on the Loan controller
*/

  /* Import the Loan controller and Model for testing */
App::import('Controller','Loans');
App::import('Model', 'Loan');

class TestLoansController extends LoansController {

  var $name = 'Loans';
  
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

/* LoansControllerTest Code */
class LoansControllerTest extends CakeTestCase {

 var $fixtures = array( 'app.book_initial_offer','app.transaction', 'app.user', 'app.book', 'app.loan' );

  function startCase() {
    echo '<h1>Starting Test Case</h1>';
  }
  
  function endCase() {
    echo '<h1>Ending Test Case</h1>';
  }

  function startTest($method) {
    echo '<h3>Starting method ' . $method . '</h3>';
    $this->Loans = new TestLoansController();
    $this->Loans->constructClasses();
    $this->Loans->Component->initialize($this->Loans);
  }

  function endTest($method) {
    echo '<hr />';
    $this->Loans->Session->destroy();
    unset($this->Loans);
    ClassRegistry::flush();
  }

  //---------------------------------------------
  // MY LOANS 
  // --------------------------------------------
  // Purpose: Displays the loans that a particular user has 
  // Test: Finds the loans for a particular user in two cases: if the user exists and has a book that he/she is willing to loan
  //       and if the user does not exist. 
  // Comments: This test works smoothly as my_loans accepts parameters which align with cakePHP unit testing 
  //         specifications 
  //
  function testmy_loans() {

    // CASE1: 
    // Call the my loans for a user that exists and has a book that the user is wiling to offer the book as a loan.
    $result1 = $this->testAction('/loans/my_loans/1',array('return' => 'vars'));
    //debug($result1);
    
    // Assert that results obtained from my books has the appropriate data values from the loan fixtures
    $this->assertEqual($result1['loan_collection_owner'][0]['loans']['client_id'], NULL);
    $this->assertEqual($result1['loan_collection_owner'][0]['loans']['owner_id'], 1);
    $this->assertEqual($result1['loan_collection_owner'][0]['loans']['book_id'], 2);
    $this->assertEqual($result1['loan_collection_owner'][0]['loans']['due_date'], 2011);
    $this->assertEqual($result1['loan_collection_owner'][0]['loans']['created'], '2011-05-08 19:47:00');
    $this->assertEqual($result1['loan_collection_owner'][0]['loans']['modified'], '2011-05-08 19:47:30');
    
    // Null checking since no other users wants to borrow this book
    $this->assertEqual($result1['loan_collection_borrower'], NULL);

    // Assert the tile for the layout has the correct field
    $this->assertEqual($result1['title_for_layout'], 'Library || My Loans');

    // CASE2: 
    // Call the my loans for a user that does not exist
    $result2 = $this->testAction('/loans/my_loans/2000',array('return' => 'vars'));
    //debug($result2);

    // Asserts that all the results are NULL since the user does not exist 
    $this->assertEqual($result2['loan_collection_borrower'], NULL);
    $this->assertEqual($result2['loan_collection_owner'], NULL);

  }

  //---------------------------------------------
  // COMPLETE LOAN 
  // --------------------------------------------
  // Purpose: Displays the loans that a particular user has 
  // Test: This test uses the loan fixture and the book_fixture to help display the results of a compelete loan
  // Comments: This test works smoothly as my_loans accepts parameters which align with cakePHP unit testing 
  //         specifications 
  //
  function testcomplete_loan() {
    
    // Call function complete_loan with the apprpriate values as parameters
    $result = $this->testAction('/loans/complete_loan/1/2/2011-10-10 19:47:00',array('return' => 'vars'));
    // debug($result);

    // Assert that results obtained from my books has the appropriate data values in the fixtures
    $this->assertEqual($result['due_date'], NULL);
    $this->assertEqual($result['book_info'][0]['books']['id'], 2);
    $this->assertEqual($result['book_info'][0]['books']['title'], 'OS');
    $this->assertEqual($result['book_info'][0]['books']['author'], 'author OS');
    $this->assertEqual($result['book_info'][0]['books']['ISBN'], 123);
    $this->assertEqual($result['book_info'][0]['books']['image'], 'path');
    $this->assertEqual($result['book_info'][0]['books']['summary'], 'this is summary');

    // Assert the tile for the layout has the correct field
    $this->assertEqual($result['title_for_layout'], 'Library || My Loans');

  }

  //---------------------------------------------
  // REMOVE LOAN 
  // --------------------------------------------
  // Purpose: Removes the corresponding loan from the database 
  // Test: This test is responsible for removing the loans that the user decides from the database.
  // Comments: This test has been disabled as the controller perform a redirect for the result and now the test page
  //           also ends up redirecting and we cannot test it this way.
  // 
  function testremove_loan() {

    /* $result = $this->testAction('/loans/remove_loan/2/1',array('return' => 'vars'));
    debug($result);

    // Assert the tile for the layout has the correct field
    $this->assertEqual($result['title_for_layout'], 'Library || My Loans'); */

  }
}

?>
