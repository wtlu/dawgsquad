<?php
    class BookFixture extends CakeTestFixture {
		var $name = 'Book';
		var $table = 'books';
	
		var $fields = array(
			'id' => array('type' => 'integer', 'key' => 'primary'),
			'title' => array('type' => 'string', 'length' => 45, 'null' => false),
			'author' => array('type' => 'string', 'length' => 45, 'null' => false),
			'ISBN' => array('type' => 'string', 'length' => 15, 'null' => false),
			'image' => array('type' => 'string', 'length' => 150, 'null' => false),
			'summary' => array('type' => 'string', 'length' => 300, 'null' => false),
		
		
		);
	
	
	/*dummy test data*/
    var $records = array(
		array ('id' => 1, 'title' => 'OS',             'author' => 'personA', 'ISBN' => '11',  'image' => 'path','summary' => 'this is summary'),
		array ('id' => 2, 'title' => 'WebProgramming', 'author' => 'personB', 'ISBN' => '22',  'image' => 'path','summary' => 'this is summary'), 
		array ('id' => 3, 'title' => 'JAVA',           'author' => 'personC', 'ISBN' => '33',  'image' => 'path','summary' => 'this is summary') 
    );
    }
?>
