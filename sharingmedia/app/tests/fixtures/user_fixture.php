<?php
    class UserFixture extends CakeTestFixture {
                var $name = 'User';
       
/*
CREATE TABLE users(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50),
	password VARCHAR(50),
	facebook_id INT(11),
	created DATETIME DEFAULT NULL,
 	modified DATETIME DEFAULT NULL 
);
*/
	   
                //create fields
                var $fields = array(
                        'id' => array('type' => 'integer', 'key' => 'primary'),
                        'name' => array('type' => 'string', 'length' => 50, 'null' => false),
                        'password' => array('type' => 'string', 'length' => 50, 'null' => false),
                        'facebook_id' => array('type' => 'integer', 'null' => false)
     
                );
       
     
				/*dummy test records to test with*/

				var $records = array(
							array ('id' => 1,
								   'name' => 'person A',
								   'password' => 'root1',
								   'facebook_id' => 1
							),
							array ('id' => 2,
								   'name' => 'person B',
								   'password' => 'root2',
								   'facebook_id' => 2
							   
							),array ('id' => 3,
								   'name' => 'person C',
								   'password' => 'root3',
								   'facebook_id' => 3
						   	)					
				);
			

  }
?>

