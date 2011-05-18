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
	$book_title = $this->data['Transaction']['title'];
	$book_id = $this->data['Transaction']['book_id'];
	$user_name = $this->data['Transaction']['name'];
	$user_id = $this->data['Transaction']['user_id'];
	$book_author = $this->data['Transaction']['author'];
	$book_isbn = $this->data['Transaction']['isbn'];
	$book_image = $this->data['Transaction']['image'];
	
	$this->set('book_title', $book_title);
	$this->set('book_id', $book_id);
	$this->set('user_name', $user_name);
	$this->set('user_id', $user_id);
	$this->set('book_author', $book_author);
	$this->set('book_isbn', $book_isbn);
	$this->set('book_image', $book_image);


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

  function transactions($book_title = null, $book_author = null, $book_isbn = null, $book_image = null, $book_id = null, $book_name = null, $user_id = null, $user_name = null, $price = null, $duration = null) {
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'accept transaction');
		
		
		$book_title = $this->data['Transaction']['title'];
		$book_id = $this->data['Transaction']['book_id'];
		$user_name = $this->data['Transaction']['name'];
		$user_id = $this->data['Transaction']['user_id'];
		$book_author = $this->data['Transaction']['author'];
		$book_isbn = $this->data['Transaction']['isbn'];
		$book_image = $this->data['Transaction']['image'];
		
		$this->set('book_title', $book_title);
		$this->set('book_id', $book_id);
		$this->set('user_name', $user_name);
		$this->set('user_id', $user_id);
		$this->set('book_author', $book_author);
		$this->set('book_isbn', $book_isbn);
		$this->set('book_image', $book_image);

		//Set to a default value of NULL
		$price = "NULL";
		if (isset($this->data['Transaction']['price'])){
			$price = $this->data['Transaction']['price'];
		};
		$this->set('price', $price);

		//Set to a default value of NULL
		$duration = "NULL";
		if (isset($this->data['Transaction']['duration'])){
			$duration = $this->data['Transaction']['duration'];
		};
		$this->set('duration', $duration);

		/* This page is only called from add books results, so there will be no trade information
		// This should be in the counteroffer page.
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
		*/

		


		/* Create an entry in the transactions table with the correct information */
		//Make sure there is not already a transaction between 2 people about the same book.
		$add_status = false;
<<<<<<< local
		$duplicate = $this->Transaction->query('SELECT * FROM transactions WHERE client_id = ' . $this->Session->read('uid') . ' AND owner_id = ' . $user_id . 'AND status  = 0 AND book_id = ' . $book_id . ';');
=======
		$duplicate = $this->Transaction->query('SELECT *
												FROM transactions
												WHERE client_id = ' . $this->Session->read('uid') . '
												AND owner_id = ' . $user_id . '
												AND status  = 0
												AND book_id = ' . $book_id . ';');
>>>>>>> other
		if(!empty($duplicate)){
			echo "<h2> You cannot propose a transaction for the same book with the same user twice. </h2>";
		}else{
			$add_status = true;
			//Add new tuple in the transaction table to track this transaction
<<<<<<< local
			$this->Transaction->query('INSERT INTO transactions(owner_id, client_id, book_id, current_id, trade_id, duration, price, status, created) VALUES(' . $user_id. ',' . $this->Session->read('uid') . ',' . $book_id . ',' . $user_id . ', -1,' . $duration . ',' . $price .', 0, NOW());');
=======
			$this->Transaction->query('INSERT INTO transactions(owner_id, client_id, book_id, current_id, trade_id, duration, price, status, created)
													VALUES(' . $user_id. ',' . $this->Session->read('uid') . ',' . $book_id . ',' . $user_id . ', -1,' . $duration . ',' . $price .', 0, NOW());');
>>>>>>> other
		}





  }

	function accept_transaction() {
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Library || My Transactions');
		
		$title = $this->data['Transaction']['title'];
		$author = $this->data['Transaction']['author'];
		$ISBN = $this->data['Transaction']['ISBN'];
		$image = $this->data['Transaction']['image'];
		
		$name = $this->data['Transaction']['name'];
		$user_id = $this->data['Transaction']['user_id'];
	}

	function my_transactions() {
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Library || My Transactions');
  }

  	function complete_transaction() {
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Library || My Transactions');
  }

    function counter_transaction() {
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Library || My Transactions');
  }

}
?>
