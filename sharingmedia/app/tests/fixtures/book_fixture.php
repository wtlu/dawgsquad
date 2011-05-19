<?php
    class BookFixture extends CakeTestFixture {
                var $name = 'Book';
               
               
                //create fields
                var $fields = array(
                        'id' => array('type' => 'integer', 'key' => 'primary'),
                        'title' => array('type' => 'string', 'length' => 45, 'null' => false),
                        'author' => array('type' => 'string', 'length' => 45, 'null' => false),
                        'ISBN' => array('type' => 'string', 'length' => 15, 'null' => false),
                        'image' => array('type' => 'string', 'length' => 150, 'null' => false),
                        'summary' => array('type' => 'text', 'length' => 300, 'null' => false)
               
               
                );
       
       
				/*dummy test records to test with*/
				
				var $records = array(
						array ('id' => 1,
								   'title' => 'Web Programming',
								   'author' => ' Marty Stepp',
								   'ISBN' => '578012391',  
								   'image' => 'path',
								   'summary' => 'this is summary'
						)
					   
				);
   


			   








   }
?>

