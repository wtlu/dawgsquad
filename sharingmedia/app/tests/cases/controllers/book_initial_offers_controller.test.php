<?php
/* 
 * File:app/tests/cases/controllers/book_initial_offers_controller.test.php -->
 * Created: 5/10/2011
 * Author: Jedidiah Jonathan
 * Purpose: Unit testing for the Book Initial Offer Controller 
	Changelog:
        5/10/2011 - Jedidiah Jonathan- Created file (skeleton)
	5/11/2011 - Jedidiah Jonathan- Testing for all functions in the book_intial_offers_controller added
	5/17/2011 - Greg Brandt - Removed support code for redirection, got fixture to work
	5/18/2011 - Jedidiah Jonathan - Testing completed for feature release
	5/27/2011 - Jedidiah Jonathan - Test updated to reflect current controller code. Some tests are disabled. Read corresponding notes. 
	5/31/2011 - Jedidiah Jonathan - Tests update, only 2 tests have been disabled, which need code refactor as parameters are not being passed. 
*/

  /* Import the Book Initial Offer controller and Model for testing */
App::import('Controller','BookInitialOffers');
App::import('Model', 'BookInitialOffer');

class TestBookInitialOffersController extends BookInitialOffersController {

  var $name = 'BookInitialOffers';
  
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

/* BookInitialOfferControllerTest Code */
class BookInitialOffersControllerTest extends CakeTestCase {

 var $fixtures = array( 'app.book_initial_offer','app.transaction', 'app.user', 'app.book', 'app.loan' );

  function startCase() {
    echo '<h1>Starting Test Case</h1>';
  }
  
  function endCase() {
    echo '<h1>Ending Test Case</h1>';
  }

  function startTest($method) {
    echo '<h3>Starting method ' . $method . '</h3>';
    $this->BookInitialOffers = new TestBookInitialOffersController();
    $this->BookInitialOffers->constructClasses();
    $this->BookInitialOffers->Component->initialize($this->BookInitialOffers);
  }

  function endTest($method) {
    echo '<hr />';
    $this->BookInitialOffers->Session->destroy();
    unset($this->BookInitialOffers);
    ClassRegistry::flush();
  }
	     
  //---------------------------------------------
  // INITIAL OFFER DETAILS 
  // --------------------------------------------
  // Purpose: The available book information is made available to the 
  //          intial_offer_detail.ctp
  // Test: This function just grabs the information from the add books 
  //       results page and sets that book choosen. But since this invloves the 
  //       interaction between the add book results page, which is a part of integration 
  //       test and not unit test. A trivial assertion is perfromed.
  // Comments: If the code is refactored in the future then this function will have the 
  //           book choosen as argument and then the initial offer details can be calculated from there.  
  // 
  function testinitial_offer_details(){
    
    // Call the function  
    $result= $this->testAction('/book_initial_offers/initial_offer_details/',
			       array('return' => 'vars'));
    // debug just used to display the result in the test screen
    // debug($result);
    
    $this->assertEqual($result['title_for_layout'], 'initial_of_details');
  }
  
  //---------------------------------------------
  // MY BOOKS  
  // --------------------------------------------
  // Purpose: Displays all books listed by the user and  the offer details of each books
  // Test: This test uses the fixtures: book_fixture and the book_initial_offer_fixture 
  //       and for a given user id, finds the associated books and the initial offer details
  //       for each book.
  // Comments: This test works smoothly as my_books accepts parameters which align with cakePHP unit testing 
  //         specifications 
  // 
  function testmy_books(){

    // Call the my_books function with user_id 1
    $result = $this->testAction('/book_initial_offers/my_books/1',array('return' => 'vars'));

    // debug just used to display the result in the test screen
    //debug($result);		
    
     $this->assertTrue(!empty($result));
		  $this->assertEqual($result['title_for_layout'], 'My Books');
		  		  
		  // Assert that results obtained from my books has the appropriate data values in the book_fixture
		  $this->assertEqual($result['book_collection'][0]['books']['id'], 10);
		  $this->assertEqual($result['book_collection'][0]['books']['title'], 'Web Programming');
		  $this->assertEqual($result['book_collection'][0]['books']['author'], 'Marty Stepp');
		  $this->assertEqual($result['book_collection'][0]['books']['ISBN'], 578012391);
		  $this->assertEqual($result['book_collection'][0]['books']['image'], 'path');
		  $this->assertEqual($result['book_collection'][0]['books']['summary'], 'this is summary');

		  // Assert that results obtained from my books has the appropriate data values in the book_initial_offer_fixture
		  $this->assertEqual($result['book_collection'][0]['book_initial_offers']['user_id'], 1);
		  $this->assertEqual($result['book_collection'][0]['book_initial_offers']['book_id'], 10);
		  $this->assertEqual($result['book_collection'][0]['book_initial_offers']['trade_id'], -1);
		  $this->assertEqual($result['book_collection'][0]['book_initial_offers']['duration'], NULL);
		  $this->assertEqual($result['book_collection'][0]['book_initial_offers']['price'], 100);
		  $this->assertEqual($result['book_collection'][0]['book_initial_offers']['created'], '2011-05-08 19:47:00');
		  $this->assertEqual($result['book_collection'][0]['book_initial_offers']['modified'], '2011-05-08 19:47:30');		  
  }

  //---------------------------------------------
  // REMOVE CONFIRM  
  // --------------------------------------------
  // Purpose: Confirmation page called when selecting remove from my library page.
  // Test: This test uses the fixtures: book_fixture and the book_initial_offer_fixture 
  //       and for a given user id and book id, finds the associated books and the initial offer details
  //       for each book.
  // Comments: This test works smoothly as remove_confirm accepts parameters which align with cakePHP unit testing 
  //         specifications 
  // 
  function testremove_confirm(){
    
    // Call the remove_confirm fucntion with the user_id 1 and book_id 10
    $result= $this->testAction('/book_initial_offers/remove_confirm/1/10',
			       array('return' => 'vars'));
    // debug just used to display the result in the test screen
    //debug($result);

     $this->assertTrue(!empty($result));
                   $this->assertEqual($result['title_for_layout'], 'My Books');

		   // Assert that results obtained from my books has the appropriate data values in the book_fixture
		  $this->assertEqual($result['offer'][0]['books']['id'], 10);
		  $this->assertEqual($result['offer'][0]['books']['title'], 'Web Programming');
		  $this->assertEqual($result['offer'][0]['books']['author'], 'Marty Stepp');
		  $this->assertEqual($result['offer'][0]['books']['ISBN'], 578012391);
		  $this->assertEqual($result['offer'][0]['books']['image'], 'path');
		  $this->assertEqual($result['offer'][0]['books']['summary'], 'this is summary');

		  // Assert that results obtained from my books has the appropriate data values in the book_initial_offer_fixture
		  $this->assertEqual($result['offer'][0]['book_initial_offers']['user_id'], 1);
		  $this->assertEqual($result['offer'][0]['book_initial_offers']['book_id'], 10);
		  $this->assertEqual($result['offer'][0]['book_initial_offers']['trade_id'], -1);
		  $this->assertEqual($result['offer'][0]['book_initial_offers']['duration'], NULL);
		  $this->assertEqual($result['offer'][0]['book_initial_offers']['price'], 100);
		  $this->assertEqual($result['offer'][0]['book_initial_offers']['created'], '2011-05-08 19:47:00');
		  $this->assertEqual($result['offer'][0]['book_initial_offers']['modified'], '2011-05-08 19:47:30');	
   

  }

  //---------------------------------------------
  // REMOVE 
  // --------------------------------------------
  // Purpose: Book is removed from users library
  // Test: This test uses the fixtures: book_fixture and the book_initial_offer_fixture 
  //       and for a given user id and book id, and removes them from the database. 
  // Comments: This test has been updated to the controller code. No issues
  // 
  function testremove(){
    
    $this->BookInitialOffer =& ClassRegistry::init('BookInitialOffer');
    $uid = 1;
    $bid = 10;
    $trade_id = -1;
    $duration = NULL;
    $price = 100;
    $created = '2011-05-08 19:47:00';
    $modified = '2011-05-08 19:47:30';
    
    $books = $this->BookInitialOffer->find('first',
  					    array('conditions' =>
  						  array('user_id' => $uid)
  						  )
  					    );
    //debug($books);
    // Assert that the current book for the user has the correct data fields 
    $this->assertEqual($books['BookInitialOffer']['user_id'],$uid);
    $this->assertEqual($books['BookInitialOffer']['book_id'],$bid);
    $this->assertEqual($books['BookInitialOffer']['trade_id'],$trade_id);
    $this->assertEqual($books['BookInitialOffer']['duration'],$duration);
    $this->assertEqual($books['BookInitialOffer']['price'],$price);
    $this->assertEqual($books['BookInitialOffer']['created'],$created);
    $this->assertEqual($books['BookInitialOffer']['modified'],$modified);

    // Call the remove function
    $this->BookInitialOffers->remove($uid,$bid);

    // Call the my_books function to check if the book has really been removed or not
    $this->BookInitialOffers->my_books($uid);

    $result = $this->BookInitialOffer->find('first',
  					    array('conditions' =>
  						  array('user_id' => $uid)
  						  )
  					    );
    //debug($result);
    // Assert that the book has been removed
    $this->assertEqual($result,NULL);

  }

  //---------------------------------------------
  // EDIT
  // --------------------------------------------
  // Purpose: Lets the user edit initial offer on the my library page
  // Test: This test uses the fixtures: book_fixture and the book_initial_offer_fixture 
  //       and for a given user id and book id, displays the results after the edit. 
  // Comments: This test works smoothly as remove_confirm accepts parameters which align with cakePHP unit testing 
  //            specifications  
  //
  function testedit(){
    
    // Call the edit function with user_id 1 and book_id 10
    $result= $this->testAction('/book_initial_offers/edit/1/10',
					     array('return' => 'vars'));
    //debug($result);
    $this->assertTrue(!empty($result));
                   $this->assertEqual($result['title_for_layout'], 'Change Offer');

		   // Assert that results obtained from my books has the appropriate data values in the book_fixture
		   $this->assertEqual($result['bid'], 10);
		   $this->assertEqual($result['trade'], -1);
		   $this->assertEqual($result['price'], 100);
		   $this->assertEqual($result['loan'], NULL);
		   $this->assertEqual($result['image'], 'path');
		   $this->assertEqual($result['author'], 'Marty Stepp');
		   $this->assertEqual($result['title'], 'Web Programming');
    
  }

  //---------------------------------------------
  // EDIT CONFIRM 
  // --------------------------------------------
  // Purpose: Simple confirmation page for the user to make sure the user is satisfied with the edit
  // Test: This test uses the fixtures: book_fixture and the book_initial_offer_fixture 
  //       and for a given user id and book id, displays confirmation results. 
  // Comments: This test works smoothly as remove_confirm accepts parameters which align with cakePHP unit testing 
  //            specifications  
  //
  function testedit_confirm(){

    // Call edit_confirm with user id 1 and book id 10 
    $result= $this->testAction('/book_initial_offers/edit_comfirm/1/10',
			       array('return' => 'vars'));
    //debug($result);
    $this->assertTrue(!empty($result));
                   $this->assertEqual($result['title_for_layout'], 'Comfirm New Offer');

		   // Assert that results obtained from my books has the appropriate data values in the book_fixture
		   $this->assertEqual($result['bid'], 10);
		   $this->assertEqual($result['image'], 'path');
		   $this->assertEqual($result['author'], 'Marty Stepp');
		   $this->assertEqual($result['title'], 'Web Programming');
    
  }

  //---------------------------------------------
  // ADD BOOKS CONFIRM 
  // --------------------------------------------
  // Purpose: Simple confirmation page for the user to make sure the user is satisfied with the books they are adding. 
  // Test: This test uses the fixtures: book_fixture and the book_initial_offer_fixture 
  //       and for a given user id and book id, displays confirmation results. 
  // Comments: This test has been disabled as the controller code does not pass the parameters to the functions
  //          and this does not help in testing. Read the note below.
  // 
 function testadd_books_confirm(){
		  
   debug('Testing the add_book_confirm');
		 
   // NOTE: THE TESTS BELOW HAVE BEEN COMMENTED OUT AS THE INTERFACE FOR THIS FUNCTION HAS NOT BEEN DEFINED IN ACCORDANCE WITH 
   // PASSING PARAMETERS WHICH IS VERY SIGNIFICANT FOR TESTING
   // THIS REQUIRES A REFACTOR IN THE FUNCTION SIGNATURE AND BODY; AND THE TEAM HAS DECIDED TO POSTPONE (or DOCUMENT) THE 
   // REFACTOR PLAN FOR LATER.
   
   /*$result = $this->testAction('/book_initial_offers/add_books_confirm',
    array('return' => 'vars'));
    debug($result);
    
    // Assert that results obtained from add books confirm to have the appropriate data values
    // Cannot access the uid from the test here as it is currently being implemented using the Session. 
    // Therefore these results will just be NULL 
    
    $this->assertEqual($result['title_for_layout'], 'initial_of_details');
    
    // Expected values is NULL 
    $this->assertEqual($result['title'], NULL);
    $this->assertEqual($result['author'], NULL);*/
 }  

  //---------------------------------------------
  // ADD BOOKS TO MUY LIBRARY
  // --------------------------------------------
  // Purpose: Add the book to the users library. 
  // Test: This test uses the fixtures: book_fixture and the book_initial_offer_fixture 
  //       and for a given user id and book id, displays confirmation results. 
  // Comments: This test has been disabled as the controller code does not pass the parameters to the functions
  //          and this does not help in testing. Read the note below.
  // 
 function testadd_book_to_mylibrary(){
   
   debug('Testing the addbook_to_mylibrary');
   
   // NOTE: THE TESTS BELOW HAVE BEEN COMMENTED OUT AS THE INTERFACE FOR THIS FUNCTION HAS NOT BEEN DEFINED IN ACCORDANCE WITH 
   // PASSING PARAMETERS WHICH IS VERY SIGNIFICANT FOR TESTING
   // THIS REQUIRES A REFACTOR IN THE FUNCTION SIGNATURE AND BODY; AND THE TEAM HAS DECIDED TO POSTPONE (or DOCUMENT) THE 
   // REFACTOR PLAN FOR LATER.
   
   /*$title= 'Continuous Media Databases';
    $author= 'Abraham Silberschatz';
    $ISBN= 9780792378181;
    $image= 'http://bks1.books.google.com/books?id=Ba77UV67q40C&printsec=frontcover&img=1&zoom=5&edge=curl';
    $offer_type= NULL;
    $offer_value= NULL;
    
    $result = $this->testAction('/book_initial_offers/1/$title/$author/$ISBN/$image/$offer_type/$offer_value',
    array('return' => 'vars'));
    debug($result);
    
    // Expected output to be NULL since we are adding a book into a user's library. But we have no way to change the uid for this session.
    $this->assertEqual($result['title'], NULL);
    $this->assertEqual($result['author'], NULL);
    $this->assertEqual($result['ISBN'], NULL);
    $this->assertEqual($result['image'], NULL);*/
		  
 }
 
		
 
} /*End Test code for BookInitialOfferController */
?>