<?php
    class BookFixture extends CakeTestFixture {
		var $name = 'Book';
		var $table = 'test_books';
		//if books table exist, delete and create again with the following fields
		
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
			   'title' => 'OS',
			   'author' => 'personA', 
			   'ISBN' => '11',  
			   'image' => 'path',
			   'summary' => 'this is summary'
		)
		
    );
    }
?>
