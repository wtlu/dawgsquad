<?php
class BookInitialOfferFixture extends CakeTestFixture {
  var $name = 'BookInitialOffer';

  /* table definition */
  var $fields = array(
		      'user_id' => array('type' => 'integer', 'key' => 'primary'),
		      'book_id' => array('type' => 'integer'),
		      'trade_id' => array('type' => 'integer'),
		      'duration' => array('type' => 'integer'),
		      'price' => array('type' => 'float')
		      );

  /* status:
   *   0 : pending
   *   1 : rejected
   *   2 : accepted
   */

  /* dummy test data */
  var $records = array(
		       array ('user_id' => '1', 'book_id' => '10','trade_id' => null,
			      'duration' => null, 'price' => '100.0'
			      )
		       );
}
?>