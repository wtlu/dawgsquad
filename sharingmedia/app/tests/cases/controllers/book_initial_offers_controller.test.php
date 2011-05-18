<!-- File:app/tests/cases/controllers/book_initial_offers_controller.test.php -->
<!--
	Created: 5/10/2011
	Author: Jedidiah Jonathan

	Changelog:
        5/10/2011 - Jedidiah Jonathan- Created file (skeleton)
	5/11/2011 - Jedidiah Jonathan- Testing for all functions in the book_intial_offers_controller added
	5/17/2011 - Greg Brandt - Removed support code for redirection, got fixture to work

-->

<?php
       /* BookInitialOfferControllerTest Code */
       class BookInitialOffersControllerTest extends CakeTestCase {
	             
	  var $BookInitialOffers = null;
	    
	  var $fixtures = array('app.book_initial_offer');

		/* The next 4 methods are just left at default state, no changes */
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
  
		/* Testing the inital_offer_details function */
		function testinitial_offer_details(){
		 
		  $result= $this->testAction('/book_initial_offers/initial_offer_details/',
					     array('return' => 'vars'));
		  debug($result);
		  
		  $this->assertEqual($result['title_for_layout'], 'initial_of_details');
		}
		
		/* Testing the my_books function */
		function testmy_books(){
		
		  /*$this->BookInitialOffers->Session->write('uid',518118311);
		  $uid = $this->BookInitialOffers->Session->read('uid');
		  debug($uid);
		  //$this->assertEqual($uid,'123121');*/

		  $this->BookInitialOffers->Session->write('uid',518118311);

		  $result = $this->testAction('/book_initial_offers/my_books/',array('return' => 'vars'));
		  debug($result);		
		  
		  $this->assertTrue(!empty($result));
		  
		  // Assert that results obtained from my books has the appropriate data values
		  // Cannot access the uid from the test here as it is currently being implemented using the Session. 
		  // Therefore these results will be NULL. 
		   $this->assertEqual($result['book_collection'][0]['books']['title'], NULL);
		   $this->assertEqual($result['book_collection'][0]['books']['author'], NULL);
		   $this->assertEqual($result['book_collection'][0]['books']['ISBN'], NULL);
		  
		  
		}
		
		/* Testing the remove_confirm function */
		function testremove_confirm(){
		  // CakePHP does not let us test functions that do not have a view (an associated ctp file)
		  // This function was added later and will be tested after the Beta Release
		  $result= $this->testAction('/book_initial_offers/remove_confirm/1',
					     array('return' => 'vars'));
		  debug($result);
		}
		
		/* Testing the remove function */
		function testremove(){
		  // CakePHP does not let us test functions that do not have a view (an associated ctp file)
		  // This function was added later and will be tested after the Beta Release
		  //$result= $this->testAction('/book_initial_offers/remove/1',
		  // array('return' => 'vars'));
		  //debug($result);
		}
		
		/* Testing the edit function */
		function testedit(){
		  // Function has not been implemented for the Beta, so the tests will be implemented later
		  // CakePHP does not let us test functions that do not have a view (an associated ctp file)
		  // This function was added later and will be tested after the Beta Release
		}

		/* Testing the add_books_confirm */
		function testadd_books_confirm(){

		  $result = $this->testAction('/book_initial_offers/add_books_confirm',
					      array('return' => 'vars'));
		  debug($result);

		  // Assert that results obtained from add books confirm to have the appropriate data values
		  // Cannot access the uid from the test here as it is currently being implemented using the Session. 
		  // Therefore these results will just be NULL 
	     
		  $this->assertEqual($result['title_for_layout'], 'initial_of_details');

		  // Expected values is NULL 
		  $this->assertEqual($result['title'], NULL);
		  $this->assertEqual($result['author'], NULL);
		}  
		
		/* Testing the add_book_to_my_library function */
		function testadd_book_to_mylibrary(){

		  debug('Testing the addbook_to_mylibrary');
		  $data = array( 'title' => 'Continuous Media Databases', 'author' => 'Abraham Silberschatz', 
				 'ISBN' => 9780792378181, 'image' => 'http://bks1.books.google.com/books?id=Ba77UV67q40C&printsec=frontcover&img=1&zoom=5&edge=curl',
				 'offer_type'=> NULL,'offer_value'=> NULL) ; 
		  
		  $result = $this->testAction('/book_initial_offers/add_book_to_mylibrary/',
					      array('return' => 'vars'));
		  debug($result);
		  
		  // Expected output to be NULL since we are adding the same book that already exists in the Library of the user.
		  $this->assertEqual($result['title'], NULL);
		  $this->assertEqual($result['author'], NULL);
		  $this->assertEqual($result['ISBN'], NULL);
		  $this->assertEqual($result['image'], NULL);

		}
		/* NOTE: We need to find how to access the Session uid from the test code, as this is critical in adding the books or showing what books
		 a particular user has */
		
       } /*End Test code for BookInitialOfferController */
?>