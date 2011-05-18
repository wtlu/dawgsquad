<?php

/* This assumes that the status for the transaction is
 * 0 - pending; 1 - rejected; 2 - accepted.
 * We should definitely make that an enum or something later.
 * This is just quick-and-dirty skeleton code.
 *  -- Greg
 *
 *		Changelog:
 *		5/12/2011 - John Wang - Added function for accept transaction()
 */

App::import('Sanitize');

class TransactionsController extends AppController {
  var $name = 'Transactions';
  var $helpers = array('Form', 'Html');

  /* owner agrees on users proposed medium of exchange
   * pre: transaction is pending
   * post: transaction is completed (status == 2)
   */
  function acceptTransaction($tid) {
    /* get the transaction */
    $t = $this->Transaction->query("SELECT * FROM transactions WHERE id = $tid");

    /* do all the update stuff */

    /* post info to view for updating / test */
    $this->set('transaction_info', $t[0]);

  }

  /* updates the current offer
   * pre: transaction is pending
   * post: this->trade_id OR this->duration OR this->price updated
   */
  function counterTransaction($tid, $type, $offer) {
    /* get the transaction */
    $t = $this->Transaction->query("SELECT * FROM transactions WHERE id = $tid");

    /* do all the update stuff */

    /* post info to view for updating / test */
    $this->set('transaction_info', $t[0]);
  }

  /* changes state of transaction to rejected
   * pre: transaction is pending
   * post: transaction is rejected */
  function rejectTransaction($tid) {
    /* get the transaction */
    $t = $this->Transaction->query("SELECT * FROM transactions WHERE id = $tid");

    /* do all the update stuff */

    /* post info to view for updating / test */
    $this->set('transaction_info', $t[0]);
  }

  function transactions($price = null, $duration = null) {
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'accept transaction');
		$book_title = $this->data['Transaction']['title'];
		$book_id = $this->data['Transaction']['book_id'];
		$user_name = $this->data['Transaction']['name'];
		$user_id = $this->data['Transaction']['user_id'];

		$price = "NULL";
		if (isset($this->data['Transaction']['price'])){
			$price = $this->data['Transaction']['price'];
		};
		$this->set('price', $price);

		if (isset($this->data['Transaction']['duration'])){
			$duration = $this->data['Transaction']['duration'];
		};
		$this->set('duration', $duration);

		if (isset($this->data['Transaction']['allow_trade'])){
			$allow_trade = $this->data['Transaction']['allow_trade'];
			$trade_books = $this->Transaction->query('SELECT books.*
				FROM book_initial_offers b_i_o, books books
				WHERE b_i_o.user_id = ' . $this->Session->read('uid') . '
					AND b_i_o.trade_id = 1
					AND b_i_o.book_id = books.id;');
			# debug($trade_books);
			$this->set('allow_trade', $allow_trade);
			$this->set('trade_books', $trade_books);
		};

		$this->set('book_title', $book_title);
		$this->set('user_name', $user_name);
		
		
		/* Create an entry in the transactions table with the correct information */
		$this->Transaction->query('INSERT INTO transactions(owner_id, client_id, book_id, current_id, trade_id, duration, price, status, created) VALUES(' . $user_id. ',' . $this->Session->read('uid') . ',' . $book_id . ',' . $user_id . ', NULL,' . $duration . ',' . $price .', 0, NOW());');
		
  }

	function accept_transaction() {
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Library || My Transactions');
	}

	function my_transactions() {
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Library || My Transactions');
  }

  	function confirm_transaction() {
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Library || My Transactions');
  }

    function counter_transaction() {
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Library || My Transactions');
  }

}
?>
