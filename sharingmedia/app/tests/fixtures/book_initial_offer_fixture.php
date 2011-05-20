<?php
class BookInitialOfferFixture extends CakeTestFixture {
  var $name = 'BookInitialOffer';

  /* table definition */
  var $fields = array(
		      'user_id' => array('type' => 'integer', 'key' => 'primary'),
		      'book_id' => array('type' => 'integer'),
		      'trade_id' => array('type' => 'integer'),
		      'duration' => array('type' => 'integer'),
		      'price' => array('type' => 'float'),
		      'created' => 'datetime',
		      'modified' => 'datetime'
		      );

  /* status:
   *   0 : pending
   *   1 : rejected
   *   2 : accepted
   */

  /* dummy test data */
  var $records = array(
		       array ('user_id' => 1, 'book_id' => 10,'trade_id' => 1,
			      'duration' => null, 'price' => 100.0,
			      'created' => '2011-05-08 19:47:00',
			      'modified' => '2011-05-08 19:47:30'
			      ),
		       array ('user_id' => 2, 'book_id' => 1,'trade_id' => 2,
			      'duration' => null, 'price' => 100.0,
			      'created' => '2011-05-08 19:47:00',
			      'modified' => '2011-05-08 19:47:30'
			      )
		       );
}
?>