<?php
/**
 * File		: /app/tests/cases/transactions_controller.test.php
 * Author	: Greg Brandt
 * Purpose	: Tests transactions controller
 * Notes	: Assumes functions in transactions controller are updated
 *                to adhere to MVC (take parameters, etc...)
 */

App::import('Model', 'Transaction');
App::import('Controller', 'Transactions');

class TestTransactionsController extends TransactionsController {

  var $name = 'Transactions';
  
  var $autoRender = false;
  
  function redirect($url, $status = null, $exit = true) {
    $this->redirectUrl = $url;
  }
  
  function render($action = null, $layout = null, $file = null) {
    $this->renderedAction = $action;
  }
  
  function _stop($status = 0) {
    $this->stopped = $status;
  }

}

class TransactionsControllerTest extends CakeTestCase {

  var $fixtures = array( 'app.transaction', 'app.user', 'app.book', 'app.loan', 'app.book_initial_offer' );

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
    echo '<h3>Starting method ' . $method . '...</h3>';
    $this->Transactions = new TestTransactionsController();
    $this->Transactions->constructClasses();
    $this->Transactions->Component->initialize($this->Transactions);
  }

  function endTest($method) {
    echo '<hr />';
    $this->Transactions->Session->destroy();
    unset($this->Transactions);
    ClassRegistry::flush();
  }

  //--------------------------------------------------
  // METHOD TESTS
  //--------------------------------------------------

  /**
   * purpose	: tests successfully establishing a new transaction
   * expected	: transaction is added to DB
   */
  function testTransactions() {

    /* init */
    $this->Transaction =& ClassRegistry::init('Transaction');

    /* params */
    $book_id		= 1;		/* web programming */
    $owner_id		= 1;
    $client_id		= 2;
    $price		= 100.0;
    $duration		= -1;
    $allow_trade	= -1;

    /* set dummy data... REMOVE / INTEGRATE WHEN POSSIBLE */
    $this->Transactions->data['Transaction']['title'] = 'title';
    $this->Transactions->data['Transaction']['author'] = 'author';
    $this->Transactions->data['Transaction']['isbn'] = '1234';

    /* add the transaction */
    $result = $this->Transactions->transactions($client_id, $book_id, $owner_id, $price, $duration, $allow_trade, $client_id);

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
    $this->assertTrue($transaction['Transaction']['duration'] == -1);		/* mutual exclusivity */
    $this->assertTrue($transaction['Transaction']['trade_id'] == -1);		/* mutual exclusivity */

    /* try to add it again (shouldn't be able to) */
    $result = $this->Transactions->transactions($book_id, $owner_id, $price, $duration, $allow_trade, $client_id);

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

  /**
   * purpose	: tests successfully moving transaction to 'completed' state
   * expected	: transaction is completed
   */
  function testAcceptTransactionSuccess() {

    /* init */
    $this->Transaction =& ClassRegistry::init('Transaction');
    
    /* params */
    $transaction_id = 100;
    $book_id = 10;
    $owner_id = 100;
    $price = 100.0;
    $duration = -1;
    $client_id = 200;
    $allow_trade = -1;
    
    /* accept it */
    $result = $this->Transactions->accept_transaction($book_id, $owner_id, $price, $duration, $client_id, $allow_trade);

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
    $transaction_id	= 200;
    $book_id		= 20;
    $owner_id		= 100;
    $price		= 100.0;
    $duration		= null;
    $client_id		= 200;
    $allow_trade	= -1;
    
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

    /* check that status is still rejected */
    $this->assertTrue($transaction['Transaction']['status'] == -1);

  }

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

  /**
   * purpose	: tests countering transaction w/ same type
   * expected	: transaction is updated with new offer
   * conditions : counter_transaction is of form...
   *              counter_transaction( $transaction_id, $type, $offer )
   */
  function testMakeOfferSameType() {

    /* init */
    $this->Transaction =& ClassRegistry::init('Transaction');

    /* params */
    $current_id		= 400;
    $book_id		= 10;
    $owner_id		= 300;
    $client_id		= 400;
    $allow_trade	= -1;
    $transaction_id	= 300;
    $new_offer		= 50.0;

    /* get the transaction */
    $transaction = $this->Transaction->find('first',
  					    array('conditions' =>
  						  array('id' => $transaction_id)
  						  )
  					    );

    /* set up view data... REMOVE WHEN POSSIBLE */
    $this->Transactions->data['Transaction']['book_title'] = 'Web Programming';
    $this->Transactions->data['Transaction']['book_author'] = 'Marty Stepp';
    $this->Transactions->data['Transaction']['book_isbn'] = '578012391';
    $this->Transactions->data['Transaction']['book_image'] = 'path';
    $this->Transactions->data['Transaction']['book_id'] = 10;
    $this->Transactions->data['Transaction']['owner_name'] = 'Greg B';
    $this->Transactions->data['Transaction']['owner_id'] = 300;
    $this->Transactions->data['Transaction']['client_id'] = 400;
    $this->Transactions->data['Transaction']['loan_duration'] = -1;
    $this->Transactions->data['Transaction']['sell_price'] = $new_offer;
    $this->Transactions->data['Transaction']['offer_sell'] = "sell";
    $this->Transactions->data['Transaction']['offer_loan'] = "loan"; /* this shouldn't be here; just here so we can set data correctly */

    /* make the new offer */
    $this->Transactions->make_offer($client_id);

    /* get the transaction */
    $transaction = $this->Transaction->find('first',
  					    array('conditions' =>
  						  array('id' => $transaction_id)
  						  )
  					    );

    /* ensure offer was updated, and other offer types are still null */
    $this->assertTrue($transaction['Transaction']['id'] == $transaction_id);	/* right one */
    $this->assertTrue($transaction['Transaction']['price'] == $new_offer);	/* updated offer */
    $this->assertTrue($transaction['Transaction']['trade_id'] == -1);		/* mutually exclusive */
    $this->assertTrue($transaction['Transaction']['duration'] == -1);		/* mutually exclusive */

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
    $current_id		= 400;
    $book_id		= 10;
    $owner_id		= 300;
    $client_id		= 400;
    $allow_trade	= -1;
    $transaction_id	= 300;
    $new_offer		= 12;

    /* get the transaction */
    $transaction = $this->Transaction->find('first',
  					    array('conditions' =>
  						  array('id' => $transaction_id)
  						  )
  					    );

    /* set up view data... REMOVE WHEN POSSIBLE */
    $this->Transactions->data['Transaction']['book_title'] = 'Web Programming';
    $this->Transactions->data['Transaction']['book_author'] = 'Marty Stepp';
    $this->Transactions->data['Transaction']['book_isbn'] = '578012391';
    $this->Transactions->data['Transaction']['book_image'] = 'path';
    $this->Transactions->data['Transaction']['book_id'] = 10;
    $this->Transactions->data['Transaction']['owner_name'] = 'Greg B';
    $this->Transactions->data['Transaction']['owner_id'] = 300;
    $this->Transactions->data['Transaction']['client_id'] = 400;
    $this->Transactions->data['Transaction']['loan_duration'] = $new_offer;
    $this->Transactions->data['Transaction']['sell_price'] = -1;
    $this->Transactions->data['Transaction']['offer_sell'] = "sell";
    $this->Transactions->data['Transaction']['offer_loan'] = "loan"; /* this shouldn't be here; just here so we can set data correctly */

    /* make the new offer */
    $this->Transactions->make_offer($client_id);

    /* get the transaction */
    $transaction = $this->Transaction->find('first',
  					    array('conditions' =>
  						  array('id' => $transaction_id)
  						  )
  					    );

    /* ensure offer was updated, and other offer types are still null */
    $this->assertTrue($transaction['Transaction']['id'] == $transaction_id);	/* right one */
    $this->assertTrue($transaction['Transaction']['price'] == -1);	/* updated offer */
    $this->assertTrue($transaction['Transaction']['trade_id'] == -1);		/* mutually exclusive */
    $this->assertTrue($transaction['Transaction']['duration'] == $new_offer);		/* mutually exclusive */

  }

  //--------------------------------------------------
  // USE CASE TESTS
  //--------------------------------------------------

  /**
   * purpose		: tests a variation of exchange book use case
   * participants	: Owner, Client
   * conditions		: counter_transaction is of form...
   *                      counter_transaction( $transaction_id, $type, $offer )
   *
   * actions
   *  1) Owner has offered book @ $100
   *  2) Client counters @ $50
   *  3) Owner counters @ $70
   *  4) Client accepts
   */
  function testUseCaseFirst() {

    /* init */
    $this->Transaction =& ClassRegistry::init('Transaction');

    /* params */
    $current_id		= 400;
    $book_id		= 10;
    $owner_id		= 300;
    $client_id		= 400;
    $allow_trade	= -1;
    $transaction_id	= 300;

    //--------------------------------------------------
    // Client counters @ $5
    //--------------------------------------------------

    $client_new_offer = 50.0;

    /* get the transaction */
    $transaction = $this->Transaction->find('first',
  					    array('conditions' =>
  						  array('id' => $transaction_id)
  						  )
  					    );

    /* set up view data... REMOVE WHEN POSSIBLE */
    $this->Transactions->data['Transaction']['book_title'] = 'Web Programming';
    $this->Transactions->data['Transaction']['book_author'] = 'Marty Stepp';
    $this->Transactions->data['Transaction']['book_isbn'] = '578012391';
    $this->Transactions->data['Transaction']['book_image'] = 'path';
    $this->Transactions->data['Transaction']['book_id'] = 10;
    $this->Transactions->data['Transaction']['owner_name'] = 'Greg B';
    $this->Transactions->data['Transaction']['owner_id'] = 300;
    $this->Transactions->data['Transaction']['client_id'] = 400;
    $this->Transactions->data['Transaction']['loan_duration'] = -1;
    $this->Transactions->data['Transaction']['sell_price'] = $client_new_offer;
    $this->Transactions->data['Transaction']['offer_sell'] = "sell";
    $this->Transactions->data['Transaction']['offer_loan'] = "loan"; /* this shouldn't be here; just here so we can set data correctly */

    /* make the new offer */
    $this->Transactions->make_offer($client_id);

    /* get the transaction */
    $transaction = $this->Transaction->find('first',
  					    array('conditions' =>
  						  array('id' => $transaction_id)
  						  )
  					    );

    /* ensure offer was updated, and other offer types are still null */
    $this->assertTrue($transaction['Transaction']['id'] == $transaction_id);		/* right one */
    $this->assertTrue($transaction['Transaction']['price'] == $client_new_offer);	/* updated offer */
    $this->assertTrue($transaction['Transaction']['trade_id'] == -1);			/* mutually exclusive */
    $this->assertTrue($transaction['Transaction']['duration'] == -1);			/* mutually exclusive */

    //--------------------------------------------------
    // Owner counters @ $7
    //--------------------------------------------------

    $owner_new_offer = 70.0;

    /* get the transaction */
    $transaction = $this->Transaction->find('first',
  					    array('conditions' =>
  						  array('id' => $transaction_id)
  						  )
  					    );

    /* set up view data... REMOVE WHEN POSSIBLE */
    $this->Transactions->data['Transaction']['book_title'] = 'Web Programming';
    $this->Transactions->data['Transaction']['book_author'] = 'Marty Stepp';
    $this->Transactions->data['Transaction']['book_isbn'] = '578012391';
    $this->Transactions->data['Transaction']['book_image'] = 'path';
    $this->Transactions->data['Transaction']['book_id'] = 10;
    $this->Transactions->data['Transaction']['owner_name'] = 'Greg B';
    $this->Transactions->data['Transaction']['owner_id'] = 300;
    $this->Transactions->data['Transaction']['client_id'] = 400;
    $this->Transactions->data['Transaction']['loan_duration'] = -1;
    $this->Transactions->data['Transaction']['sell_price'] = $owner_new_offer;
    $this->Transactions->data['Transaction']['offer_sell'] = "sell";
    $this->Transactions->data['Transaction']['offer_loan'] = "loan"; /* this shouldn't be here; just here so we can set data correctly */

    /* make the new offer */
    $this->Transactions->make_offer($owner_id);

    /* get the transaction */
    $transaction = $this->Transaction->find('first',
  					    array('conditions' =>
  						  array('id' => $transaction_id)
  						  )
  					    );

    /* ensure offer was updated, and other offer types are still null */
    $this->assertTrue($transaction['Transaction']['id'] == $transaction_id);		/* right one */
    $this->assertTrue($transaction['Transaction']['price'] == $owner_new_offer);	/* updated offer */
    $this->assertTrue($transaction['Transaction']['trade_id'] == -1);			/* mutually exclusive */
    $this->assertTrue($transaction['Transaction']['duration'] == -1);			/* mutually exclusive */

    //--------------------------------------------------
    // Client accepts
    //--------------------------------------------------

    /* accept it */
    $result = $this->Transactions->accept_transaction($book_id, $owner_id, $owner_new_offer, -1, $client_id, -1);

    /* get that transaction from the db */
    $transaction = $this->Transaction->find('first',
  					    array('conditions' =>
  					    	  array(
  							'id' => $transaction_id
  					    		)
  					    	  )
  					    );

    /* check that it's accepted */
    $this->assertTrue($transaction['Transaction']['id'] == $transaction_id);	/* right one */
    $this->assertTrue($transaction['Transaction']['status'] == 1);		/* accepted */

  }

  /**
   * purpose		: tests a variation of exchange book use case
   * participants	: Owner, Client
   * conditions		: counter_transaction is of form...
   *                      counter_transaction( $transaction_id, $type, $offer )
   *
   * actions
   *  1) Owner has offered Book 123 @ $10
   *  2) Client counters @ loan for 10 days
   *  3) Owner rejects
   */
  function testUseCaseSecond() {

    /* init */
    $this->Transaction =& ClassRegistry::init('Transaction');

    /* params */
    $current_id		= 400;
    $book_id		= 10;
    $owner_id		= 300;
    $client_id		= 400;
    $allow_trade	= -1;
    $transaction_id	= 300;

    //--------------------------------------------------
    // Client counters @ loan for 10 days
    //--------------------------------------------------

    $client_new_offer = 12;

    /* get the transaction */
    $transaction = $this->Transaction->find('first',
  					    array('conditions' =>
  						  array('id' => $transaction_id)
  						  )
  					    );

    /* set up view data... REMOVE WHEN POSSIBLE */
    $this->Transactions->data['Transaction']['book_title'] = 'Web Programming';
    $this->Transactions->data['Transaction']['book_author'] = 'Marty Stepp';
    $this->Transactions->data['Transaction']['book_isbn'] = '578012391';
    $this->Transactions->data['Transaction']['book_image'] = 'path';
    $this->Transactions->data['Transaction']['book_id'] = 10;
    $this->Transactions->data['Transaction']['owner_name'] = 'Greg B';
    $this->Transactions->data['Transaction']['owner_id'] = 300;
    $this->Transactions->data['Transaction']['client_id'] = 400;
    $this->Transactions->data['Transaction']['loan_duration'] = $client_new_offer;
    $this->Transactions->data['Transaction']['sell_price'] = -1;
    $this->Transactions->data['Transaction']['offer_sell'] = "sell";
    $this->Transactions->data['Transaction']['offer_loan'] = "loan"; /* this shouldn't be here; just here so we can set data correctly */

    /* make the new offer */
    $this->Transactions->make_offer($client_id);

    /* get the transaction */
    $transaction = $this->Transaction->find('first',
  					    array('conditions' =>
  						  array('id' => $transaction_id)
  						  )
  					    );

    /* ensure offer was updated, and other offer types are still null */
    $this->assertTrue($transaction['Transaction']['id'] == $transaction_id);		/* right one */
    $this->assertTrue($transaction['Transaction']['price'] == -1);			/* updated offer */
    $this->assertTrue($transaction['Transaction']['trade_id'] == -1);			/* mutually exclusive */
    $this->assertTrue($transaction['Transaction']['duration'] == $client_new_offer);	/* mutually exclusive */

    //--------------------------------------------------
    // Owner accepts
    //--------------------------------------------------

    /* reject it */
    $result = $this->Transactions->cancel_transaction($transaction_id, $owner_id);

    /* get that transaction from the db */
    $transaction = $this->Transaction->find('first',
  					    array('conditions' =>
  					    	  array(
  							'id' => $transaction_id
  					    		)
  					    	  )
  					    );

    /* check that it's gone */
    $this->assertTrue($transaction == null);

  }

}

?>