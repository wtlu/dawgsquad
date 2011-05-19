<?php
/**
 * File		: /app/tests/cases/transactions_controller.test.php
 * Author	: Greg Brandt
 * Purpose	: Tests transactions controller
 * Notes	: Assumes functions in transactions controller are updated
 *                to adhere to MVC (take parameters, etc...)
 */
class TransactionsControllerTest extends CakeTestCase {

  var $fixtures = array('app.transaction');

  //--------------------------------------------------
  // SETUP
  //--------------------------------------------------

  function startCase() {
    echo '<h1>Starting Test Case</h1>';
  }
  
  function endCase() {
    echo '<h1>Ending Test Case</h1>';
  }

  function startTest($method) {
    echo '<h3>Starting method ' . $method . '</h3>';
  }

  function endTest($method) {
    echo '<hr />';
  }

  //--------------------------------------------------
  // TRANSACTION
  //--------------------------------------------------

  /**
   * purpose	: tests successfully establishing a new transaction
   * expected	: transaction is added to DB
   * conditions : transactions is of the form...
   *              transactions($price, $duration, $book_id, $owner_id, $client_id)
   */
  function testTransactionsUnique() {

    /* get owner, client, and book */

    /* add the transaction */

    /* check to see if that transaction is in the DB */
    
  }

  /**
   * purpose	: tests adding a duplicate transaction
   * expected	: transaction is not added to DB
   * conditions : transactions is of the form...
   *              transactions( $price, $duration, $book_id, $owner_id, $client_id )
   */
  function testTransactionsDuplicate() {

    /* get owner, client, and book */

    /* attempt add the transaction */

    /* ensure only one copy of transaction in DB */
    
  }

  //--------------------------------------------------
  // ACCEPT_TRANSACTION
  // -- note: all you need for this (logically) is the transaction id
  //--------------------------------------------------

  /**
   * purpose	: tests successfully moving transaction to 'completed' state
   * expected	: transaction is completed
   * conditions : transaction is pending; accept_transaction is of form...
   *              accept_transaction( $transaction_id )
   */
  function testAcceptTransactionSuccess() {

    /* get a transaction from fixture that's pending */

    /* accept it */

    /* check that it's accepted */

  }

  /**
   * purpose	: tests unsuccessfully moving transaction to 'completed' state
   * expected	: transaction is rejected
   * conditions : transaction is rejected; accept_transaction is of form...
   *              accept_transaction( $transaction_id )
   */
  function testAcceptTransactionFailure() {

    /* get a transaction from fixture that's rejected */

    /* accept it */

    /* check that it's rejected still */

  }

  //--------------------------------------------------
  // MY TRANSACTIONS
  //--------------------------------------------------

  /**
   * purpose	: tests displaying transactions for user
   * expected	: test user has three transactions
   * conditions : my_transactions is of form...
   *              my_transactions( $user_id )
   */
  function testMyTransactions() {

    /* look up user's transactions */

    /* make sure all transactions are the same as those in fixture w/ that user */
   
  }

  //--------------------------------------------------
  // CONFIRM TRANSACTION
  //--------------------------------------------------
  
  /**
   * purpose	: tests confirming transaction
   * expected	: transaction is accepted and confirmed
   * conditions : confirm_transaction is of form...
   *              confirm_transaction( $transaction_id )
   */
  function testConfirmTransactionPositive() {

    /* get transaction */

    /* ensure transaction has been accepted */

    /* set transaction confirmed */
    // NOTE: NO CONFIRMED STATE IN MODEL

  }

  //--------------------------------------------------
  // COUNTER TRANSACTION
  //--------------------------------------------------

  /**
   * purpose	: tests countering transaction w/ same type
   * expected	: transaction is updated with new offer
   * conditions : counter_transaction is of form...
   *              counter_transaction( $transaction_id, $type, $offer )
   */
  function testCounterTransactionSameType() {

    /* get the transaction */

    /* update the transaction offer */

    /* ensure offer was updated, and other offer types are still null */

  }
  
  /**
   * purpose	: tests countering transaction w/ different type
   * expected	: transaction remains the same (exceptions thrown?)
   * conditions : counter_transaction is of form...
   *              counter_transaction( $transaction_id, $type, $offer )
   */
  function testCounterTransactionDiffType() {
    
    /* get the transaction and remember original offer */

    /* try to update the two other types with the offer */

    /* ensure the two other types are null (and possibly exceptions thrown...) */

    /* ensure that the original offer is still the same */

  }

  }
?>