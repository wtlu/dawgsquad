<?php

/* This assumes that the status for the transaction is
 * 0 - pending; 1 - rejected; 2 - accepted.
 * We should definitely make that an enum or something later.
 * This is just quick-and-dirty skeleton code.
 *  -- Greg
 */

class TransactionsController extends AppController {
  var $name = 'Transactions';
  var $helpers = array('Form', 'Html');

  /* owner agrees on user's proposed medium of exchange 
   * pre: transaction is pending
   * post: transaction is completed (status == 2)
   */
  function acceptTransaction() {
    
  }

  /* owner or user terminates transaction
   * pre: transaction is pending
   * post: transaction is rejected
   */  
  function rejectTransaction() {
    
  }

  /* updates the current offer 
   * pre: transaction is pending
   * post: this->trade_id OR this->duration OR this->price updated
   */
  function counterTransaction($type, $offer) {
    
  }

  /* displays user's current transactions */
  function showTransaction($id = null) {
    
  }
}
?>