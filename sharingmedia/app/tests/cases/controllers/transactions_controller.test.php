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

  function testAcceptTransaction() {
    $result = $this->testAction('/transactions/acceptTransaction/1',
				array('return' => 'vars'));
    $this->assertEqual($result['accept_info']['transactions']['status'], '2');
    debug($result);
  }

  function testCounterTransaction() {
    $result = $this->testAction('/transactions/counterTransaction/1/sell/50.0',
				array('return' => 'vars'));

    /* test for mutual exclusivity */
    $this->assertEqual($result['counter_info']['transactions']['trade_id'], null);
    $this->assertEqual($result['counter_info']['transactions']['duration'], null);
    $this->assertEqual($result['counter_info']['transactions']['price'], 50.0);
    $this->assertEqual($result['counter_info']['transactions']['status'], 0); /* pending */

    debug($result);
  }
}
?>