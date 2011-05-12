<!-- File: /app/controllers/book_controller.php -->

<!--
question left
1. how to use fixture
2. how to have user input value in method


-->

<?php
	/*import controller*/
	App::import('Controller','Books');
    
	/* extends controller*/
	class TestBooks extends BooksController {
		/*do not rendering automatically*/
		/*let the view render not controller*/
		/*render is for view*/
		var $autoRender = false;
		
		
		/* overwirte parent's redirect method if exits
		 * let redirect direct to redirectURL
		 * can do test without doing actual redirect
		 */
		function redirect($url, $status = null, $exit = true){
			$this->redirectUrl = $url;
		}	
		
	}
	class BooksControllerTest extends CakeTestCase{
		var $Books = null;
		
		
		/*create instance with TestBooks which is a child of BooksController*/
		function setUp(){
			$this->Books = new TestBooks();
			$this->Books->constructClasses();
		
		}
		
		/*instance check*/	
		function testBooksControllerInstance(){
			$this->assertTrue(is_a($this->Books, 'BooksController'));
			debug("correctlly created instance of Books");
			
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

		/*functions above checks if initiated correctly or not. 
		 * the true test function starts from here
		 */

		 
		/*step 1: examines data 
		 *  checks Book's id =1 's contents
		 *  
		 */
		 function testFindData(){
			/*read Book's id = 1 then store it to the res*/
			$this->Books->Book->id = 1;
			$res = $this->Books->Book->read();
			
			debug($res);
			$this ->assertNotNull($res['Book']);
			$this ->assertEqual($res['Book']['id'], 1);
		 
		 }
		  
		  
		/* step 2: examine each Action ( actoin is the view )
		 *
		 * get the result of "action"
	 	 * then examines it.
		 *
		 * 2 important thing:
		 * array('return' => 'render') is rendering results ( what to be displayes)
		 * array('return' => 'vars') is the data passes to the views
		 *
		 * Plan: examine vars to see if we are passing expected data to the view
		 * $var = $this->testAction('actionpath', 'return valeu');
		 *  
		 *
		 */
  
		/* display what we are passing to the view when add_books_results() gets called*/  
		function testAdd_books_results() {
			$result = $this->testAction('/Books/add_books_results', array('return' => 'vars'));
			debug($result);
		}		  
		  

		/*display what is being rendered to view (add_books.ctp) when add_books are called */
		function testAdd_books() {
			$result = $this->testAction('/Books/add_books', array('return' => 'render'));
			debug(htmlentities($result));
		}
		
		
		/**/
		function testAdd_books_resultsFixturized(){
			
			$result = $this->testAction('/Books/add_books_results', array('fixturize' => true));
			
			
			debug($result);
		
		 
		 }
		
		
		function testAdd_books_resultsFixturized2() {
			
			$data = array(
				"Book" =>array(
					"book_title" => "OS"
					
				)
			);
			
			$result = $this->testAction('/Books/add_books_results', array('fixturize' => true, 'data' => $data, 'method' => 'post'));
			debug($result); 
		}	
	}	
?>