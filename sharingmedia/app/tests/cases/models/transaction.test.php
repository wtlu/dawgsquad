<?php
App::import('Model', 'Transaction');

class TransactionTestCase extends CakeTestCase {
  var $fixtures = array('app.transaction');

  function testAcceptTransaction() {
    /* instantiate class and run method */
    $this->Transaction =& ClassRegistry::init('Transaction');
    $this->Transaction->acceptTransaction();
    $data = $this->Transaction->read();

    /* compare against expected */
    $result = $data['Transaction']['status'];
    $expected = 2;
    $this->assertEqual($result, $expected);
  }

  function testRejectTransaction() {
    /* instantiate class and run method */
    $this->Transaction =& ClassRegistry::init('Transaction');
    $this->Transaction->rejectTransaction();
    $data = $this->Transaction->read();

    /* compare against expected */
    $result = $data['Transaction']['status'];
    $expected = 1;
    $this->assertEqual($result, $expected);
  }

  function testCounter() {
    /* instantiate class and run method */
    $this->Transaction =& ClassRegistry::init('Transaction');
    $this->Transaction->counterTransaction('price', '50.0');
    $data = $this->Transaction->read();

    /* compare against expected */
    $result = $data['Transaction']['price'];
    $expected = '50.0';
    $this->assertEqual($result, $expected);
  }
}
?>