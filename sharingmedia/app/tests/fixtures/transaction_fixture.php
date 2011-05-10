<?php
class TransactionFixture extends CakeTestFixture {
  var $name = 'Transaction';

  /* table definition */
  var $fields = array(
		      'id' => array('type' => 'integer', 'key' => 'primary'),
		      'owner_id' => array('type' => 'integer'),
		      'client_id' => array('type' => 'integer'),
		      'book_id' => array('type' => 'integer'),
		      'current_id' => array('type' => 'integer'),
		      'trade_id' => array('type' => 'integer'),
		      'duration' => array('type' => 'integer'),
		      'price' => array('type' => 'float'),
		      'status' => array('type' => 'integer'),
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
		       array ('id' => '1', 'owner_id' => '100', 'client_id' => '200',
			      'book_id' => '10', 'current_id' => '100', 'trade_id' => null,
			      'duration' => null, 'price' => '100.0', 'status' => '0',
			      'created' => '2011-05-08 19:47:00',
			      'modified' => '2011-05-08 19:47:30'
			      )
		       );
}
?>