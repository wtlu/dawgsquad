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

  function transactions($book_id = null, $owner_id = null, $price = "NULL", $duration = "NULL", $allow_trade = 0) {
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'accept transaction');

		//Get book and owner result back from database
		$book_result = $this->Transaction->query('SELECT * FROM books WHERE id = ' . $book_id . ' ;');
		$owner_result = $this->Transaction->query('SELECT * FROM users WHERE facebook_id = ' . $owner_id . ' ;');



		//Set to a default value of NULL
		if (isset($this->data['Transaction']['price'])){
			$price = $this->data['Transaction']['price'];
		};
		$this->set('price', $price);

		//Set to a default value of NULL
		if (isset($this->data['Transaction']['duration'])){
			$duration = $this->data['Transaction']['duration'];
		};
		$this->set('duration', $duration);

		//Set to a default value of 0
		if (isset($this->data['Transaction']['allow_trade'])){
			$allow_trade = $this->data['Transaction']['allow_trade'];
		}
		$this->set('allow_trade', $allow_trade);


		//Make the parameter data available in the view

		$data['Transaction']['book_title'] = $book_result[0]['books']['title'];
		$data['Transaction']['book_id'] = $book_id;
		$data['Transaction']['owner_name'] = $owner_result[0]['users']['name'];
		$data['Transaction']['owner_id'] = $owner_id;
		$data['Transaction']['book_author'] = $book_result[0]['books']['author'];
		$data['Transaction']['book_isbn'] = $book_result[0]['books']['ISBN'];
		$data['Transaction']['book_image'] = $book_result[0]['books']['image'];

		$data['Transaction']['price'] = $price;
		$data['Transaction']['duration'] = $duration;
		$data['Transaction']['allow_trade'] = $allow_trade;
		$this->set('data', $data);


		/* Create an entry in the transactions table with the correct information */
		//Make sure there is not already a transaction between 2 people about the same book.
		$add_status = false;
		$duplicate = $this->Transaction->query('SELECT *
												FROM transactions
												WHERE client_id = ' . $this->Session->read('uid') . '
												AND owner_id = ' . $owner_id . '
												AND status  = 0
												AND book_id = ' . $book_id . ';');
		if(!empty($duplicate)){
			echo "<h2> You cannot propose a transaction for the same book with the same user twice. </h2>";
		}else{
			$add_status = true;
			//Add new tuple in the transaction table to track this transaction
			$this->Transaction->query('INSERT INTO transactions(owner_id, client_id, book_id, current_id, trade_id, duration, price, status, created)
													VALUES(' . $owner_id. ',' . $this->Session->read('uid') . ',' . $book_id . ',' . $owner_id . ', -1,' . $duration . ',' . $price .', 0, NOW());');
		}



  }

	function accept_transaction($book_id = null, $owner_id = null, $price = null, $duration = null, $allow_trade = null) {
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Library || My Transactions');

		//Get book and owner result back from database
		$book_result = $this->Transaction->query('SELECT * FROM books WHERE id = ' . $book_id . ' ;');
		$owner_result = $this->Transaction->query('SELECT * FROM users WHERE facebook_id = ' . $owner_id . ' ;');

		/*$book_title = $this->data['Transaction']['book_title'];
		$book_id = $this->data['Transaction']['book_id'];
		$owner_name = $this->data['Transaction']['owner_name'];
		$owner_id = $this->data['Transaction']['owner_id'];
		$book_author = $this->data['Transaction']['book_author'];
		$book_isbn = $this->data['Transaction']['book_isbn'];
		$book_image = $this->data['Transaction']['book_image'];*/


		if (isset($this->data['Transaction']['price'])) {
			$price = $this->data['Transaction']['price'];
		} else if (isset($this->data['Transaction']['duration'])) {
			$duration = $this->data['Transaction']['duration'];
		}
		if (isset($this->data['Transaction']['allow_trade'])) {
			$allow_trade = $this->data['Transaction']['allow_trade'];
		};

		/* This statement updates the status of this transaction to "completed" state */
		$this->Transaction->query('UPDATE transactions
									SET status = 1
									WHERE owner_id = ' . $owner_id . '
										AND client_id = ' . $this->Session->read('uid') . '
										AND book_id = ' . $book_id . '
										AND status = 0;');


		$data['Transaction']['book_title'] = $book_result[0]['books']['title'];
		$data['Transaction']['book_id'] = $book_id;
		$data['Transaction']['owner_name'] = $owner_result[0]['users']['name'];
		$data['Transaction']['owner_id'] = $owner_id;
		$data['Transaction']['book_author'] = $book_result[0]['books']['author'];
		$data['Transaction']['book_isbn'] = $book_result[0]['books']['ISBN'];
		$data['Transaction']['book_image'] = $book_result[0]['books']['image'];

		$data['Transaction']['price'] = $price;
		$data['Transaction']['duration'] = $duration;
		$data['Transaction']['allow_trade'] = $allow_trade;

		$this->set('data', $data);
	}

	//Pre: This page is transactions page when a user navigates to their Library. It takes no arguments
	//post: Returns an array of all transactions listed by the user and the details of each transactions

	function my_transactions() {
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Library || My Transactions');
		$current_user = $this->Session->read('uid');

		//pull transaction with owners that are me and initial offers from the database
		$transaction_collection = $this->Transaction->query("SELECT * FROM books b, transactions t, users u WHERE u.facebook_id = t.owner_id AND b.id = t.book_id AND (t.owner_id = ".$current_user." OR t.client_id = ".$current_user.")");

		//pass variables to page
		$this->set('transaction_collection', $transaction_collection);
		//debug($transaction_collection);
	}

   function make_offer(){

		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Library || My Transactions');

		$book_title = $this->data['Transaction']['book_title'];
		$book_id = $this->data['Transaction']['book_id'];
		$owner_name = $this->data['Transaction']['owner_name'];
		$owner_id = $this->data['Transaction']['owner_id'];
		$book_author = $this->data['Transaction']['book_author'];
		$book_isbn = $this->data['Transaction']['book_isbn'];
		$book_image = $this->data['Transaction']['book_image'];

		$duration = "NULL";
		if ($this->data['Transaction']['offer_loan'] == "loan") {
			$duration = $this->data['Transaction']['offer_loan'];
		}

		$price = "NULL";
		if ($this->data['Transaction']['offer_sell'] == "sell") {
			$price = $this->data['Transaction']['sell_price'];
		}

		$trade_id = "NULL";
		if ($this->data['Transaction']['offer_trade'] == "trade") {
			$trade_id = $this->data['Transaction']['trade_id'];
		}


		debug($trade_id);
		
		$this->set('book_title', $book_title);
		$this->set('book_id', $book_id);
		$this->set('owner_name', $owner_name);
		$this->set('owner_id', $owner_id);
		$this->set('book_author', $book_author);
		$this->set('book_isbn', $book_isbn);
		$this->set('book_image', $book_image);
		$this->set('price', $price);
		$this->set('duration', $duration);


		//Need to update the transaction tuple with the new values




  }

  function confirm_transaction($book_id = null, $owner_id = null, $offer_option = null, $price = null, $duration = null, $allow_trade = null) {

		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Library || My Transactions');

		//Get book and owner result back from database
		$book_result = $this->Transaction->query('SELECT * FROM books WHERE id = ' . $book_id . ' ;');
		$owner_result = $this->Transaction->query('SELECT * FROM users WHERE facebook_id = ' . $owner_id . ' ;');

		if (isset($this->data['Transaction']['offer_options'])) {
			$offer_option = $this->data['Transaction']['offer_options'];
		}

		if ($offer_option == "price" && isset($this->data['Transaction']['price'])) {
			$price = $this->data['Transaction']['price'];
		} else if ($offer_option == "loan" && isset($this->data['Transaction']['duration'])) {
			$duration = $this->data['Transaction']['duration'];
		}
		if (isset($this->data['Transaction']['allow_trade'])) {
			$allow_trade = $this->data['Transaction']['allow_trade'];
		};

		$data['Transaction']['book_title'] = $book_result[0]['books']['title'];
		$data['Transaction']['book_id'] = $book_id;
		$data['Transaction']['owner_name'] = $owner_result[0]['users']['name'];
		$data['Transaction']['owner_id'] = $owner_id;
		$data['Transaction']['book_author'] = $book_result[0]['books']['author'];
		$data['Transaction']['book_isbn'] = $book_result[0]['books']['ISBN'];
		$data['Transaction']['book_image'] = $book_result[0]['books']['image'];

		$data['Transaction']['price'] = $price;
		$data['Transaction']['duration'] = $duration;
		$data['Transaction']['allow_trade'] = $allow_trade;

		$this->set('data', $data);
  }




    function counter_transaction($book_id = null,
								 $owner_id = null,
							     $allow_trade = null) {

		//For CSS Styling
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Library || My Transactions');



		$book_result = $this->Transaction->query('SELECT * FROM books WHERE id = ' . $book_id . ' ;');
		$owner_result = $this->Transaction->query('SELECT * FROM users WHERE facebook_id = ' . $owner_id . ' ;');

		//Fill data with parameters, to be passed to view
		$data['Transaction']['book_title'] = $book_result[0]['books']['title'];
		$data['Transaction']['book_id'] = $book_id;
		$data['Transaction']['owner_name'] = $owner_result[0]['users']['name'];
		$data['Transaction']['owner_id'] = $owner_id;
		$data['Transaction']['book_author'] = $book_result[0]['books']['author'];
		$data['Transaction']['book_isbn'] = $book_result[0]['books']['ISBN'];
		$data['Transaction']['book_image'] = $book_result[0]['books']['image'];
		$data['Transaction']['allow_trade'] = $allow_trade;



		/* This page is only called from add books results, so there will be no trade information */
		// This should be in the counteroffer page.
		if ($allow_trade){
			$trade_books = $this->Transaction->query('SELECT books.*
				FROM book_initial_offers b_i_o, books books
				WHERE b_i_o.user_id = ' . $this->Session->read('uid') . '
					AND b_i_o.trade_id = 1
					AND b_i_o.book_id = books.id;');
			# debug($trade_books);
			$data['Transaction']['trade_books'] = $trade_books;
		}
		//Make all of data available to the view
		$this->set('data', $data);

    }

}
?>
