<!--
File: /app/tests/cases/books_controller.test.php

	Created: 5/13/2011
	Author: Tatsuro Oya

	
-->
<?php
	
	/*import controller*/
	App::import('Controller','Books');
    
	
	/*extends controller*/
	class TestBooks extends BooksController {
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
	
	
	/* BookControllerTest here */
	class BooksControllerTest extends CakeTestCase{
		var $Books = null;
		

		
		/* Create instance with TestBooks which is a child of BooksController*/
		function setUp(){
			$this->Books = new TestBooks();
			$this->Books->constructClasses();
		}		
		 
		 /* Check if BookController can correctlly creating it's instance */ 	
		function testBooksControllerInstance(){
			$this->assertTrue(is_a($this->Books, 'BooksController'));
			debug("checks if correctlly created an instance of Books");	
		}
		
		/*convention for end*/
		function tearDown(){
			unset($this->Books);
		}

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

		/* functions above checks if initiated correctly or not. 
		 * the test functions starts from here
		 */

		 
		/*Test 1: Examines Data used in controller
		 *  this test checks if the record to be retreived by this controller exists 
		 *  and checks if it displays expected record
		 *  
		 *  read Book's id =1's contents
		 *  compare with the expected value (we know the dummy var)
		 *  
		 */
		 function testFindData(){
			/*read Book's id = 1 then store it to the res1 */
			$this->Books->Book->id = 1;
			$res1 = $this->Books->Book->read();
			debug($res1);
			/* compare with the expected (dummy var) that we prepared */
			$this ->assertNotNull($res1['Book']);
			$this ->assertEqual($res1['Book']['id'], 1);
			$this ->assertEqual($res1['Book']['title'], 'Operating System Concepts');
			$this ->assertEqual($res1['Book']['author'], 'Abraham Silberschatz');
			$this ->assertEqual($res1['Book']['ISBN'], '0470128720');
			$this ->assertEqual($res1['Book']['image'], 'http://books.google.com/books?id=g710PwAACAAJ&printsec=frontcover&img=1&zoom=1&l=220');
			
		 }
		    
		
		
		/* Test2:  examine each Action function ( actoin is the view )
		 *
		 * get the result of "action" then examines it.
		 *
		 * 2 important thing:
		 * array('return' => 'render') is rendering results ( what to be displayed)
		 * array('return' => 'vars') is the data to be passed to the views  (nothing to be passed in this controller so ignore this)
		 *
		 * Quick Example: examines vars to see if the controller are passing expected data to the view
		 * $var = $this->testAction('actionpath', 'return value');
		 *  
		 */	
	
		/* Test2: Action function check
		 *        for each action we check whether each function is rendering appropriate page 
		 *        to do this we check page title and layout to see each function is choosing approproate ones 
		 *		  This can be done by parsing the 1. page title and 2. css 
		 */
		function testAddBooks() {
		
			debug('conducting render check for add_books() action method ');
			$result = $this->testAction('/Books/add_books', array('return' => 'render'));
			/* expexted page title: add_a_book */
			/* expexted css: main.css */
			/* check if they matches by parsing rendering result*/
			$this->assertPattern("/<title>add_a_book<\/title>/", $result);  
			$this->assertPattern("/<link rel=\"stylesheet\" type=\"text\/css\" href=\"\/sharingmedia\/app\/webroot\/css\/main.css\" \/>/", $result);
		}
		 
		function testFindBooks() {
		
			debug('conducting render check for find_books() action method ');
			$result = $this->testAction('/Books/find_books', array('return' => 'render'));
			/* expexted page title: find_a_book */
			/* expexted css: main.css */
			/* check if they matches by parsing rendering result*/
			$this->assertPattern("/<title>find_a_book<\/title>/", $result);  
			$this->assertPattern("/<link rel=\"stylesheet\" type=\"text\/css\" href=\"\/sharingmedia\/app\/webroot\/css\/main.css\" \/>/", $result);
		} 
		
		function testFindBooksResults() {
		
			debug('conducting render check for find_books_results() action method ');
			$result = $this->testAction('/Books/find_books_results', array('return' => 'render'));
			
			/* expexted page title: find_book_result */
			/* expexted css: main.css */
			/* check if they matches by parsing rendering result*/
			$this->assertPattern("/<title>find_book_result<\/title>/", $result);  
			$this->assertPattern("/<link rel=\"stylesheet\" type=\"text\/css\" href=\"\/sharingmedia\/app\/webroot\/css\/main.css\" \/>/", $result);
		} 
		 
		/* Test3: helper function check
		 *        checks if query_google() shows the output we expected. 
		 *		  Here we provide the isbn, author, title for computer network book   
		 *        Then checks if guery_google() retreive the book we expect
		 */
		
		
		/* checks if query_google() function returns the expected information for the book */
		function testQueryGoogle() {
			App::import('HttpSocket');
			App::import('Xml');
			$http = new HttpSocket();
			$url = 'http://books.google.com/books/feeds/volumes';
			/*giving test search value*/
			$results = & new Xml($http->get($url, 'q=isbn:0132126958+inauthor:Tanenbaum+intitle:Computer networks'));
			$results = Set::reverse($results);

			$google_results = array();

			if ($results['Feed']['totalResults'] > 0) {
				$google_results = $results['Feed']['Entry'];
			}
			
			debug( $google_results['Title'][0]['value']);
			$this->assertEqual($google_results['Title'][0]['value'], 'Computer Networks');
			return $google_results;

		}
		 
		/* checks if get_relevant_data() function appropriately filter out the information of the book obtained by query_google()*/
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
			debug($book_sub);
			$this->assertEqual($book_sub[0]['title'], 'Computer Networks');
			$this->assertEqual($book_sub[0]['author'], 'Andrew S. Tanenbaum, David Wetherall');
			$this->assertEqual($book_sub[0]['ISBN'], '0132126958');
			return $book_sub;
		}

		
	
	}	
?>