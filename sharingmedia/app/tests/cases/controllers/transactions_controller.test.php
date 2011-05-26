<?php
/**
 * File		: /app/tests/cases/transactions_controller.test.php
 * Author	: Greg Brandt
 * Purpose	: Tests transactions controller
 * Notes	: Assumes functions in transactions controller are updated
 *                to adhere to MVC (take parameters, etc...)
 */

App::import('Model', 'Transaction');

class TransactionsControllerTest extends CakeTestCase {

  var $fixtures = array( 'app.transaction', 'app.user', 'app.book', 'app.loan' );

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
   * conditions : 
   */
  function testTransactions() {

    /* init */
    $this->Transaction =& ClassRegistry::init('Transaction');

    /* params */
    $book_id	= 1;		/* web programming */
    $owner_id	= 1;
    $client_id	= 2;
    $price = 100.0;
    $duration = null;
    $allow_trade = -1;

    /* add the transaction */
    $result = $this->testAction("/transactions/transactions/$book_id/$owner_id/$price/$duration/$allow_trade/$client_id");

    /* get that transaction from the DB */
    $transaction = $this->Transaction->find('first',
    					    array('conditions' =>
    						  array('Transaction.owner_id' => $owner_id,
    							'Transaction.client_id' => $client_id,
    							'Transaction.book_id' => $book_id)
    						  )
    					    );

    /* check */
    $this->assertTrue(isset($transaction));					/* got something */
    $this->assertTrue($transaction['Transaction']['owner_id'] == $owner_id);	/* right owner */
    $this->assertTrue($transaction['Transaction']['client_id'] == $client_id);	/* right client */
    $this->assertTrue($transaction['Transaction']['current_id'] == $owner_id);	/* current offer is owner's initial offer */
    $this->assertTrue($transaction['Transaction']['price'] == 100.0);		/* right initial price */
    $this->assertTrue($transaction['Transaction']['duration'] == null);		/* mutual exclusivity */
    $this->assertTrue($transaction['Transaction']['trade_id'] == null);		/* mutual exclusivity */

    /* try to add it again (shouldn't be able to) */
    $result = $this->testAction("/transactions/transactions/$book_id/$owner_id/$client_id");

    /* make sure only one in db */
    $transaction = $this->Transaction->find('all', 
					    array('conditions' => 
						  array('Transaction.owner_id' => $owner_id, 
							'Transaction.client_id' => $client_id,
							'Transaction.book_id' => $book_id)
						  )
					    );

    $this->assertTrue(count($transaction) == 1);

  }

  //--------------------------------------------------
  // ACCEPT_TRANSACTION
  // -- note: all you need for this (logically) is the transaction id
  // --       the way it's set up is redundant
  //--------------------------------------------------

  /**
   * purpose	: tests successfully moving transaction to 'completed' state
   * expected	: transaction is completed
   */
  function testAcceptTransactionSuccess() {

    /* init */
    $this->Transaction =& ClassRegistry::init('Transaction');
    
    /* params */
    $transaction_id = 100;
    $book_id = 20;
    $owner_id = 100;
    $price = 100.0;
    $duration = null;
    $client_id = 200;
    $allow_trade = -1;
     
    /* accept it */
    $result = $this->testAction("/transactions/accept_transaction/$book_id/$owner_id/$price/$duration/$client_id/$allow_trade");

    /* get that transaction from the db */
    $transaction = $this->Transaction->find('first',
					    array('conditions' =>
					    	  array(
							'id' => 100
					    		)
					    	  )
					    );

    /* check that it's accepted */
    $this->assertTrue($transaction['Transaction']['id'] == $transaction_id);	/* right one */
    $this->assertTrue($transaction['Transaction']['status'] == 1);		/* accepted */

  }

  /**
   * purpose	: tests unsuccessfully moving transaction to 'completed' state
   * expected	: transaction is rejected
   * conditions : transaction is rejected; accept_transaction is of form...
   *              accept_transaction( $transaction_id )
   */
  function testAcceptTransactionFailure() {

    /* init */
    $this->Transaction =& ClassRegistry::init('Transaction');
    
    /* get a transaction from fixture that's rejected */
    $transaction_id = 200;
    $book_id = 20;
    $owner_id = 100;
    $price = 100.0;
    $duration = null;
    $client_id = 200;
    $allow_trade = -1;
     
    /* accept it */
    $result = $this->testAction("/transactions/accept_transaction/$book_id/$owner_id/$price/$duration/$client_id/$allow_trade");

    /* get that transaction from the db */
    $transaction = $this->Transaction->find('first', 
					    array('conditions' => 
						  array(
							'id' => $transaction_id
							)
						  )
					    );

    /* check that it's no longer in db */
    $this->assertTrue($transaction == null);

  }

  //--------------------------------------------------
  // MY TRANSACTIONS
  //--------------------------------------------------

  /**
   * purpose	: tests displaying transactions for user
   * expected	: test user has two transactions
   */
  function testMyTransactions() {

    /* init */
    $this->Transaction =& ClassRegistry::init('Transaction');

    /* params */
    $user_id = 100;

    /* look up user's transactions */
    $result = $this->testAction("/transactions/my_transactions/$user_id",
				array('return' => 'vars')
				);
    
    /* make sure both transactions for $user_id == 100 are returned */
    $this->assertEqual(count($result['transaction_collection']), 2);
  }

  //--------------------------------------------------
  // CONFIRM TRANSACTION
  // -- controller does not do significant action
  // -- no test required
  //--------------------------------------------------
  
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

    /* init */
    $this->Transaction =& ClassRegistry::init('Transaction');

    /* params */
    $transaction_id = 300;
    $type = 'sell';
    $new_offer = 50.0;

    /* update the transaction offer */
    $result = $this->testAction("/transactions/counter_transaction/$transaction_id/$type/$new_offer");
    
    /* get the transaction */
    $transaction = $this->Transaction->find('first', 
					    array('conditions' => 
						  array('id' => $transaction_id)
						  )
					    );

    /* SHOULD FAIL BECAUSE INTERFACE ILL DEFINED
     * UNCOMMENT BELOW LINES WHEN INTERFACE CORRECTLY DEFINED */
    $this->assertTrue(0);

    /* ensure offer was updated, and other offer types are still null */
    /* $this->assertTrue($transaction['Transaction']['id'] == $transaction_id);	/\* right one *\/ */
    /* $this->assertTrue($transaction['Transaction']['price'] == $new_offer);	/\* updated offer *\/ */
    /* $this->assertTrue($transaction['Transaction']['trade_id'] == null);		/\* mutually exclusive *\/ */
    /* $this->assertTrue($transaction['Transaction']['duration'] == null);		/\* mutually exclusive *\/ */

  }
  
  /**
   * purpose	: tests countering transaction w/ different type
   * expected	: transaction changes type
   * conditions : counter_transaction is of form...
   *              counter_transaction( $transaction_id, $type, $offer )
   */
  function testCounterTransactionDiffType() {

    /* init */
    $this->Transaction =& ClassRegistry::init('Transaction');

    /* params */
    $transaction_id = 300;
    $type = 'loan';
    $new_offer = 12;
    $orig_offer = 100.0;

    /* try to update the transaction offer */
    $result = $this->testAction("/transactions/counter_transaction/$transaction_id/$type/$new_offer");
    
    /* get the transaction */
    $transaction = $this->Transaction->find('first', 
					    array('conditions' => 
						  array('Transaction.id' => $transaction_id)
						  )
					    );

    /* SHOULD FAIL BECAUSE INTERFACE ILL DEFINED
     * UNCOMMENT BELOW LINES WHEN INTERFACE CORRECTLY DEFINED */
    $this->assertTrue(0);

    /* /\* ensure the transaction now has a duration, and other types are null *\/ */
    /* $this->assertTrue($transaction['Transaction']['id'] == $transaction_id);	/\* right one *\/ */
    /* $this->assertTrue($transaction['Transaction']['price'] == null );		/\* updated offer *\/ */
    /* $this->assertTrue($transaction['Transaction']['trade_id'] == null);		/\* mutually exclusive *\/ */
    /* $this->assertTrue($transaction['Transaction']['duration'] == $new_offer);	/\* mutually exclusive *\/ */
    
  }

  }
?>