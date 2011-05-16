<?php
class TransactionControllerTest extends CakeTestCase {

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

  /* tests moving transaction from pending to accepted */
  function testAcceptTransaction() {

    /**
     * NOTE: THIS ASSUMES acceptTransaction IS OF THE FORM
     * acceptTransaction($tid) WHERE $id IS THE TRANSACTION ID
     */
    
    /* accept the transaction */
    $result = $this->testAction('/transactions/acceptTransaction/1',
				array('return' => 'vars'));

    /* make sure state changed */
    $this->assertEqual($result['accept_info']['transactions']['status'], '2');

  }

  /* tests moving transaction from pending to rejected */
  function testRejectTransaction() {

    /* accept the transaction */
    $result = $this->testAction('/transactions/rejectTransaction/1',
				array('return' => 'vars'));
    
    /* make sure state changed */
    $this->assertEqual($result['accept_info']['transactions']['status'], '1');

  }

  /* updates transaction with same type
   * (i.e. new currency amount if 'price')
   */
  function testCounterTransactionSameType() {

    /* change initial offer from 100.0 to 50.0 */
    $result = $this->testAction('/transactions/counterTransaction/1/sell/50.0',
				array('return' => 'vars'));

    /* ensure mutual exclusivity */
    $this->assertEqual($result['counter_info']['transactions']['trade_id'], null);
    $this->assertEqual($result['counter_info']['transactions']['duration'], null);
    $this->assertEqual($result['counter_info']['transactions']['price'], 50.0);

    /* test status still pending (0) */
    $this->assertEqual($result['counter_info']['transactions']['status'], 0);

    /* test current_id shifted (was initially owner and now is client who made offer) */
    $this->assertEqual($result['counter_info']['transactions']['client_id'], 
		       $result['counter_info']['transactions']['current_id']);

  }

  /* attempt to accept a transaction that has already been rejcected
   * should fail / not allow */
  function testAcceptTransactionRejected() {
    
    /* call method on transaction that has already been rejected */
    $result = $this->testAction('/transactions/acceptTransaction/2',
				array('return' => 'vars'));

    /* test status still rejected (1) */
    $this->assertEqual($result['counter_info']['transactions']['status'], '1');

  }

  /* update transaction with different type
   * should fail / not allow
   */
  function testCounterTransactionDiffType() {

    /* try to set the duration to 100 days instead of a price of 100.0 */
    $result = $this->testAction('/transactions/counterTransaction/1/duration/100',
				array('return' => 'vars'));

    /* ensure trade detail fields have not changed */
    $this->assertEqual($result['counter_info']['transactions']['trade_id'], null);
    $this->assertEqual($result['counter_info']['transactions']['duration'], null);
    $this->assertEqual($result['counter_info']['transactions']['price'], 100.0);

    /* test status still pending (0) */
    $this->assertEqual($result['counter_info']['transactions']['status'], 0);

    /* test current_id not shifted because offer was invalid */
    $this->assertEqual($result['counter_info']['transactions']['client_id'], 
		       $result['counter_info']['transactions']['owner_id']);

  }

}
?>