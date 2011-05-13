<!-- File:app/tests/cases/controllers/book_initial_offers_controller.test.php -->
<!--
	Created: 5/10/2011
	Author: Jedidiah Jonathan

	Changelog:
        5/10/2011 - Jedidiah Jonathan- Created file (skeleton)
	5/11/2011 - Jedidiah Jonathan- Testing for all functions in the book_intial_offers_controller added
-->

<?php
	/*import controller*/
	App::import('Controller','BookInitialOffers');

	/*extends controller*/
	class TestBookInitialOffers extends BookInitialOffersController {
		/*do not rendering from here automatically*/
		var $autoRender = false;		
		
		/* overwirte parent's redirect method if exits
		 * let redirect direct to redirectURL
		 * can do test without doing actual redirect
		 */
		function redirect($url, $status = null, $exit = true){
			$this->redirectUrl = $url;
		}	
		
	}
       
       /* BookInitialOfferControllerTest Code */
       class BookInitialOffersControllerTest extends CakeTestCase {
	             var $BookInitialOffers = null;
				
		/* Create instance with TestBookInitialOffers which is a child of BookInitialOffersController*/
		function setUp(){
			$this->BookInitialOffers = new TestBookInitialOffers();
			$this->BookInitialOffers->constructClasses();
		}		
		 
		 /* Check if BookInitialOffersController can correctlly creating it's instance */ 	
		function testBookInitialOffersControllerInstance(){
			$this->assertTrue(is_a($this->BookInitialOffers, 'BookInitialOffersController'));
			debug("checks if correctlly created an instance of BookInitialOffers");	
		}
		
		/*convention for end*/
		function tearDown(){
			unset($this->BookInitialOffers);
		}

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
		  
		  //Testing the my_books that are already in the database (dummy_values.sql)
		  $result = $this->testAction('/book_initial_offers/my_books/1263812002',
					      array('return' => 'vars'));
		  debug($result);
		  
		  $this->assertEqual($result['title_for_layout'], 'My Books');
		  
		  debug($result['book_collection']);
		  
		  // Assert that results obtained from my books has the appropriate data values
		  /*$this->assertEqual($result['book_collection'][0]['books']['title'], 'Continuous Media Databases');
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
		
		/* Testing the remove_confirm function */
		function testremove_confirm(){
		}
		
		/* Testing the remove function */
		function testremove(){
		  
		}
		
		/* Testing the edit function */
		function testedit(){

		}

		/* Testing the add_books_confirm */
		function testadd_books_confirm(){
		  // Need to implement the test 
		  $result = $this->testAction('/book_initial_offers/add_books_confirm',
					      array('return' => 'vars'));
		  debug($result);
		}  
		
		/* Testing the add_book_to_my_library function */
		function testadd_book_to_mylibrary(){
		  // Need to implement the test
		  $data = array( 'title' => 'Continuous Media Databases', 'author' => 'Abraham Silberschatz', 
				 'ISBN' => 9780792378181, 'image' => 'http://bks1.books.google.com/books?id=Ba77UV67q40C&printsec=frontcover&img=1&zoom=5&edge=curl',
				 'offer_type'=> NULL,'offer_value'=> NULL) ; 
		  
		  $result = $this->testAction('/book_initial_offers/add_book_to_mylibrary/2/1263812002',
					      array('return' => 'vars'));
		  debug($result);
		}
		
       } /*End Test code for BookInitialOfferController */
?>