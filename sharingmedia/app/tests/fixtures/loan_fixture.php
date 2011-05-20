<?php
class LoanFixture extends CakeTestFixture {
  var $name = 'Loan';

  /* table definition */
  var $fields = array(
		      'owner_id' => array('type' => 'integer'),
		      'client_id' => array('type' => 'integer'),
		      'book_id' => array('type' => 'integer'),
		      'due_date' => array('type' => 'integer'),
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
		       array ('owner_id' => 1, 'client_id' => 10,'book_id' => 1,
			      'due_date' => '2011-10-10 19:47:00',
			      'created' => '2011-05-08 19:47:00',
			      'modified' => '2011-05-08 19:47:30'
			      )
		       );
}
?>