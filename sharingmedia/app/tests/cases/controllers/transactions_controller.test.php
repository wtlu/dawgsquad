<?php
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
  // SETUP
  //--------------------------------------------------

}
?>