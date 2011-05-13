<?php

  App::import('Controller','BookInitialOffers');


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
  
  function testinitial_offer_details(){
    // Need to implement the test
    $result = $this->testAction('/book_initial_offers/initial_offer_details',
				array('return' => 'vars'));
    debug($result);
  }

  function testmy_books(){
   // Need to implement the test 

    //Testing the my_books that are already in the database (dummy_values.sql)
    $result = $this->testAction('/book_initial_offers/my_books/1',
				array('return' => 'vars'));
    debug($result);
    
    // Assert that results obtained from my books has the appropriate data values
    $this->assertEqual($result['book_collection'][0]['books']['title'], 'Continuous Media Databases');
    $this->assertEqual($result['book_collection'][0]['books']['author'], 'Abraham Silberschatz');
    $this->assertEqual($result['book_collection'][0]['books']['ISBN'], '9780792378181');

  }

  function testadd_books_confirm(){
    // Need to implement the test 
    $result = $this->testAction('/book_initial_offers/add_books_confirm',
				array('return' => 'vars'));
  }  

  function testadd_book_to_mylibrary(){
    // Need to implement the test
    $result = $this->testAction('/book_initial_offers/add_book_to_mylibrary',
				array('return' => 'vars'));
    debug($result);
  }
  
}
?>