    <?php
    /*import model*/
	App::import('Model','Book');
    
	/* extend model*/
	class TestBook extends Book {
		/*do not cache sourse*/
		var $cacheSourses = false;
		/*decide prefix for testing*/
		var $useDbConfig = 'test_suite';
	}
	
	/*extends CakeTestCase*/
	class BookTestCase extends CakeTestCase {
		
		/* */
		var $Book = null;
		/* use model skelton prepared in fixture*/ 
		var $fixtures = array( 'app.book' );
    
	
		function startTest(){
			/*use newly initialized model for testing*/
			$this->Book = & ClassRegistry::init('Book');	
		}
		
		function endTest(){
			/*just convention*/
			unset($this->Book);
			ClassRegistry::flush();
		}
		
		
		function testBookInstance(){
			/*check whether the instance created here is same as model's instance*/
			$this->assertTrue(is_a($this->Book, 'Book'));
			
		}
		
		
		/* model's search test*/
		function testBookFind(){
			/* do not do recursive call */
			$this->Book->recursive = -1;
			
			/* take the first one */
			$results = $this->Book->find('first');
			
			/* return true if $results is not empty*/
			$this->assertTrue(!empty($results));
			
			$expected = array(
				array ('id' => 1, 'title' => 'OS',             'ISBN' => '11', 'author' => 'personA', 'image' => 'path','summary' => 'this is summary', 'created' => '2007-03-18 10:39:23', 'updated' => '2007-03-18 10:41:31')
			);
			/* return true if the two are equal*/
			$this->assertEqual($results, $expected);
		
		}
		
		
	
		// /*method name is not publishd actually*/
		// function testPublished() {
		// $this->Book =& ClassRegistry::init('Book');
		
		// $result = $this->Book->published(array('id', 'title'));
		// /*define expected values here*/
		// $expected = array(
			// array('Book' => array( 'id' => 1, 'title' => 'OS' )),
			// array('Book' => array( 'id' => 2, 'title' => 'WebProgramming' )),
			// array('Book' => array( 'id' => 3, 'title' => 'JAVA' ))
		// );
		// /*compare with the test*/
		// $this->assertEqual($result, $expected);
		// }
    }	
	?>
