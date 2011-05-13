<!-- File:app/tests/cases/controllers/book_initial_offers_controller.test.php -->
<!--
	Created: 5/10/2011
	Author: Jedidiah Jonathan

	Changelog:
        5/10/2011 - Jedidiah Jonathan- Created file (skeleton)
	5/11/2011 - Jedidiah Jonathan- Testing for all functions in the book_intial_offers_controller added
-->

<?php

  //App::import('Controller','BookInitialOffers');


class BookInitialOffersControllerTest extends CakeTestCase {

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
  
  // Testing the inital_offer_details function 
  function testinitial_offer_details(){

    $result = $this->testAction('/book_initial_offers/initial_offer_details',
				array('return' => 'vars'));
    //debug($result);
    // TODO: Need to test the book_choosen
    // $this->assertEqual($result['book_chosen'], 'initial_of_details');
    $this->assertEqual($result['title_for_layout'], 'initial_of_details');
  }

  function testmy_books(){

    //Testing the my_books that are already in the database (dummy_values.sql)
    $result = $this->testAction('/book_initial_offers/my_books/1',
				array('return' => 'vars'));
    //debug($result);
    
    // Assert that results obtained from my books has the appropriate data values
    $this->assertEqual($result['book_collection'][0]['books']['title'], 'Continuous Media Databases');
    $this->assertEqual($result['book_collection'][0]['books']['author'], 'Abraham Silberschatz');
    $this->assertEqual($result['book_collection'][0]['books']['ISBN'], '9780792378181');

    $this->assertEqual($result['trade_books'][0][0]['trades']['book_id'], 1);
    $this->assertEqual($result['trade_books'][0][0]['books']['id'], 1);

    // Code below can be used to test other book_id's in the book_initial_offers table
    // Just change the last field of the first parameter of testAction to the new book_id
    // Currently we only use the test above to test the dummy values in the DB
    /*$result2 = $this->testAction('/book_initial_offers/my_books/2',
				array('return' => 'vars'));
				debug($result2);*/

  }

  function testadd_books_confirm(){
    // Need to implement the test 
    $result = $this->testAction('/book_initial_offers/add_books_confirm',
				array('return' => 'vars'));
    debug($result);
  }  

  function testadd_book_to_mylibrary(){
    // Need to implement the test
    $result = $this->testAction('/book_initial_offers/add_book_to_mylibrary',
				array('return' => 'vars'));
    debug($result);
  }
  
}
?>