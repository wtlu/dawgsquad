   <?php
    /*import model*/
	App::import('Model','User');
    
	/* extend model*/
	class TestUser extends User {
		/*do not cache sourse*/
		var $cacheSourses = false;
		/*decide prefix for testing*/
		var $useDbConfig = 'test_suite';
	}
	
	/*extends CakeTestCase*/
	class UserTestCase extends CakeTestCase {
		
		/* */
		var $User = null;
		/* use model skelton prepared in fixture*/ 
		var $fixtures = array( 'app.user' );
    
	
		function startTest(){
			/*use newly initialized model for testing*/
			$this->User = & ClassRegistry::init('User');	
		}
		
		function endTest(){
			/*just convention*/
			unset($this->User);
			ClassRegistry::flush();
		}
		
		
		function testUserInstance(){
			/*check whether the instance created here is same as model's instance*/
			$this->assertTrue(is_a($this->User, 'User'));
			
		}
		
		
		/* model's search test*/
		function testUserFind(){
			/* do not do recursive call */
			$this->User->recursive = -1;
			
			/* take the first one */
			$results = $this->User->find('first');
			
			/* return true if $results is not empty*/
			$this->assertTrue(!empty($results));
			
			$expected = array(
				array ('id' => 1, 'name' => 'Wei-Ting Lu', 'password' => null, 'facebook_id' => '518118311', 'created' => '' )
			);
			/* return true if the two are equal*/
			$this->assertEqual($results, $expected);
		
		}
		
		
	
		// /*method name is not publishd actually*/
		// function testPublished() {
		// $this->User =& ClassRegistry::init('User');
		
		// $result = $this->User->published(array('id', 'title'));
		// /*define expected values here*/
		// $expected = array(
			// array('User' => array( 'id' => 1, 'title' => 'OS' )),
			// array('User' => array( 'id' => 2, 'title' => 'WebProgramming' )),
			// array('User' => array( 'id' => 3, 'title' => 'JAVA' ))
		// );
		// /*compare with the test*/
		// $this->assertEqual($result, $expected);
		// }
    }	
	?>
