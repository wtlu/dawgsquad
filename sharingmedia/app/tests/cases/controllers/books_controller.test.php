<?php
/**
 * File		: /app/tests/cases/books_controller.test.php
 * Author	: Tatsuro Oya
 * Purpose	: Tests books controller
 * Notes	: This is the unit test module for BooksController function.
 *	 		  We ensure whether this module is working or not by
 *	 		  creating dummy database, then prepare the expected results for each function
 *			  and compare them with each function's return value.
 *	 		  If it matches, it proves that the function is working correctly
 */

       		
/* BookControllerTest */
class BooksControllerTest extends CakeTestCase{
		   
	/* use model skelton prepared in fixture*/
	var $fixtures = array( 'app.user', 'app.book', 'app.book_initial_offer', 'app.transaction', 'app.loan' );
	
	//--------------------------------------------------
	// SETUP
	//--------------------------------------------------
 
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
	}

	function endTest($method) {
			/*executed after method*/
			echo '<hr />';
	}

	//--------------------------------------------------
	// find_books_results
	//--------------------------------------------------		
	
	/* Test1 : find_books_results 
	 * Description:  
	 * 		This test checks whether find_books_results is giving the correct output.
	 * 		In this function, we are assuming that the find_books_results is taking the 4 arguments
	 * 			1. $book_title
	 * 			2. $book_author
	 * 			3. $book_isbn
	 * 			4. $sessionID
	 * How to evaluate:
	 * 		 find_books_results searched the book from other people's library.  
	 *		 Testing this function by giving $book_title, $book_author, $book_isbn, ,and &sessionID.
	 *		 Then compare with the expected value. We set up dummy values in data base using fixture
	 *		 Thus, we know what we should get beforehead.
	 *
	 *
	 *
	 */
	function testFindBooksResults() {

		/* init */
		$this->Book =& ClassRegistry::init('Book');

		/* params */
		$book_title	= 'Web Programming';		/* web programming */
		$book_author	= 'Marty Stepp';
		$book_isbn	= '578012391';
		$session_id = 3;
		
		debug('conducting render check for find_books_results() action method ');
			$result = $this->testAction('/Books/find_books_results/Web Programming/Marty Stepp/578012391/3', 
										array('return' => 'vars')
				);

			//debug($result);
			$this->assertEqual($result['book_results']['0']['books']['title'], 'Web Programming');
			$this->assertEqual($result['book_results']['0']['books']['author'], 'Marty Stepp');
			$this->assertEqual($result['book_results']['0']['books']['ISBN'], '578012391');			
	}		
	
	
	//--------------------------------------------------
	// add_books_results
	//--------------------------------------------------		

	
	
	/* Test2: add_books_results 
	 * Description:  
	 * 		This test checks whether add_books_results is giving the correct output.
	 * 		The function works in the following way:
	 *		
	 *		First, it takes the input from user and concatenate them so that it is recognized by google_book_search 
	 *		which is google API that requires the input to be specific format.
	 *		
	 *		Second, pass the concatenated string to  query_google this function output the result for that book.
	 *
	 *		Third, pass the result to get_relevant_data() and filter out the unnecessaty data 
	 *
	 * How to evaluate:
	 * 		 We divide the function into 3 main components based on the explanation above. 
	 *		 
	 *	 	 First part(Test2-1) checks if the function is creating the correct string 
	 *		 that can be recognized by google_book_search. We do this by comparing the output
	 *		 with the expected output.
	 *
	 *		 Second part(Test2-2) checks if the string outputs the book informatin which we are 
	 *       expecting to get.
	 *		 
	 *   	 Finally, make sure that it filters out correctlly
	 *
	 *
	 *
	 */
	 
	 
	/* Test 2-1: 
	 *		 checks if the function is creating the correct string 
	 *		 that can be recognized by google_book_search. We do this by comparing the output
	 *		 with the expected output. 
	 */
	function testAddBooksResults() {

		debug('conducting render check for add_books_results() action method ');
		
		/* here I hard coded the data from user because we cannot do this automatically */
		$book_title = 'Computer Networks';
		$book_author = 'Tanenbaum';
		$book_isbn = '0132126958';
		$index = 1; //this is set to 1 by default

		# build the search string to send to Google books
		$search_string = 'q=';
		if (!empty($book_isbn)) {
				$search_string = $search_string . 'isbn:' . $book_isbn;
		}
		if (!empty($book_title)) {
				$book_title = str_replace(" ", "+intitle:", $book_title);
				$search_string = $search_string . '+intitle:' . $book_title;
		}
		if (!empty($book_author)) {
				$book_author = str_replace(" ", "+inauthor:", $book_author);
				$search_string = $search_string . '+inauthor:' . $book_author;
		}
		$search_string = $search_string . '&start-index=' . $index . '&max-results=5';
		debug($search_string);
		$expected = 'q=isbn:0132126958+intitle:Computer+intitle:Networks+inauthor:Tanenbaum&start-index=1&max-results=5';
		$this->assertEqual($search_string, $expected);
	}
	  
						 
	/* Test2-2: helper function check
	 *        checks if query_google() shows the output we expected. 
	 *		  Here we provide the isbn, author, title for computer network book   
	 *        Then checks if guery_google() retreive the book we expect
	 */
	function testQueryGoogle() {
		App::import('HttpSocket');
		App::import('Xml');
		$http = new HttpSocket();
		$url = 'http://books.google.com/books/feeds/volumes';
		/*giving test search value*/
		$results = & new Xml($http->get($url, 'q=isbn:0132126958+intitle:Computer+intitle:Networks+inauthor:Tanenbaum&start-index=1&max-results=5'));
		$results = Set::reverse($results);

		$google_results = array();

		if ($results['Feed']['totalResults'] > 0) {
			$google_results = $results['Feed']['Entry'];
		}
		//debug($google_results);
		debug( $google_results['Title'][0]['value']);
		$this->assertEqual($google_results['Title'][0]['value'], 'Computer Networks');
		return $google_results;

	}
 
	/* Test2-3: helper function check
	 * checks if get_relevant_data() function appropriately filter out the information 
	 * of the book obtained by query_google()*/
	function testGetRelevantData() {

		$result = $this->testQueryGoogle();

		$title = $result['Title'][1];
		# check to see if this book has a second title and add it
		if (array_key_exists(2, $result['Title'])) {
			$title = $title . ': ' . $result['Title'][2];
		}
		$author = '';
		# check to see if this book has multiple authors
		if (array_key_exists('creator', $result)) {
			$author = $result['creator'];
		} else if (array_key_exists('Creator', $result)) {
			$author = $result['Creator'][0];
			for ($i = 1; $i < count($result['Creator']); $i++) {
				$author = $author . ', '. $result['Creator'][$i];
			}
		}
		
		$ISBN = str_replace('ISBN:', '', $result['Identifier'][1]);
		# check to see if this book result has an image, and if not, replace with generic thumbnail
		if ($result['Link'][0]['type'] == 'image/x-unknown') {
			$image = $result['Link'][0]['href'];
			$image = str_replace('zoom=5', 'zoom=1', $image);
		} else {
			$image = 'http://books.google.com/googlebooks/images/no_cover_thumb.gif';
		}
		$summary = '';
		if (array_key_exists('description', $result)) {
			$summary = $result['description'];
		}

		$relevant_stuff = array('title' => $title, 'author' => $author,
			'ISBN' => $ISBN, 'image' => $image, 'summary' => $summary);

		$book_sub = array($relevant_stuff);
		//debug($book_sub);
		$this->assertEqual($book_sub[0]['title'], 'Computer Networks');
		$this->assertEqual($book_sub[0]['author'], 'Andrew S. Tanenbaum, David Wetherall');
		$this->assertEqual($book_sub[0]['ISBN'], '0132126958');
		return $book_sub;
	}

	function testBrowseBooksResults() {

		/* init */
		$this->Book =& ClassRegistry::init('Book');

		$session_id = 3;
		
		debug('conducting render check for browse_books_results() action method ');
			$result = $this->testAction('/Books/browse_books_results/3', 
										array('return' => 'vars')
				);

			debug($result);
					
	}		
	


	

}      
?>


