<?php
class Transaction extends AppModel {
  var $name = 'Transaction';

  /* owner agrees on user's proposed medium of exchange 
   * pre: transaction is pending
   * post: transaction is completed
   */
  function accept_transaction() {

  }

  /* owner or user terminates transaction
   * pre: transaction is pending
   * post: transaction is rejected
   */  
  function reject_transaction() {
    
  }

  /* updates the current offer 
   * pre: transaction is pending
   * post: this->trade_id OR this->duration OR this->price updated
   */
  function counter() {
    
  }

  /* displays user's current transactions */
  function show_transaction($id = null) {
    
  }
}
?>