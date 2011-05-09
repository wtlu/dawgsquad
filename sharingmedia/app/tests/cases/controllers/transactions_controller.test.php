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
    $result = $this->testAction('/transactions/acceptTransaction',
				array('return' => 'vars'));
    
    /* make sure every transaction (usually 1) was completed */
    foreach ($result as $r) {
      $this->assertEqual($r[0]['transactions']['status'], '2');
    }

  }

  function testCounter() {
    $result = $this->testAction('/transactions/counterTransaction');
    debug($result);
  }
}
?>