<!--
File: /app/tests/cases/books_controller.test.php

        Created: 5/13/2011
        Author: Tatsuro Oya

       
-->
<?php
       
        /*import controller*/
        App::import('Controller','Books');
		App::import('Model', 'Loan');
		App::import('Model', 'BookInitialTransaction');
		App::import('Model', 'BookInitilOffer');
       	App::import('Model', 'User');
       
        /* BookControllerTest here */
        class BooksControllerTest extends CakeTestCase{
               
                /* use model skelton prepared in fixture*/
				var $fixtures = array( 'app.book, app.book_initial_offer, app.user' );
				
				
  
               

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

                 
               
                   
             
               
				function testFindBooksResults() {
               
                        debug('conducting render check for find_books_results() action method ');
                        $result = $this->testAction('/Books/find_books_results/Web Programming/Marty Stepp/578012391', array('return' => 'vars',
                                                                                'fixturize' => true,
                                                                                'method' => 'post'
                                                                               
                                                                                )
                         
                        );
                        debug($result);
                       
				}
               
               
           
				
					
       
        }      
?>

