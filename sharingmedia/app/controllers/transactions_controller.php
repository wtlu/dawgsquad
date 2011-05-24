<?php

/* This assumes that the status for the transaction is
 * 0 - pending; 1 - rejected; 2 - accepted.
 * We should definitely make that an enum or something later.
 * This is just quick-and-dirty skeleton code.
 *  -- Greg
 *
 *		Changelog:
 *		5/12/2011 - John Wang - Added function for accept transaction()
 *		5/18/2011 - James Parsons - Troy Martin - John Wang - Wrote many of the methods for displaying, accepting, confirming, countering transactions
 *		5/19/2011 - James Parsons - Troy Martin - John Wang - Finished most of this controller
 */

App::import('Sanitize');

class TransactionsController extends AppController {
  var $name = 'Transactions';
  var $helpers = array('Form', 'Html');

  //Pre: Called from find_books_results to initiate a transaction, or from myTransactions in myLibrary to continue or update a transactions.
  //Post: Creates a tuple in transactions with pertinent information, allows user to choose to accept the current offer or make a counteroffer.
  function transactions($book_id = "NULL", $owner_id = "NULL", $price = "NULL", $duration = "NULL", $allow_trade = -1, $client_id = "NULL") {
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'accept transaction');

		//Get book and owner result back from database
		$book_result = $this->Transaction->query('SELECT * FROM books WHERE id = ' . $book_id . ' ;');
		$owner_result = $this->Transaction->query('SELECT * FROM users WHERE facebook_id = ' . $owner_id . ' ;');

		$search_title = $this->data['Transaction']['title'];
		$search_author = $this->data['Transaction']['author'];
		$search_isbn = $this->data['Transaction']['isbn'];
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

		/*
		//Set to a default value of 0
		if (isset($this->data['Transaction']['allow_trade'])){
			$allow_trade = $this->data['Transaction']['allow_trade'];
		}
		$this->set('allow_trade', $allow_trade);
		*/

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
		$data['Transaction']['client_id'] = $client_id;


		$data['Transaction']['allow_trade'] = $allow_trade;
		$this->set('allow_trade', $allow_trade);
		if($allow_trade > 0){
			//Get info about the book to be traded
			$trade_result = $this->Transaction->query('SELECT * FROM books WHERE id = ' . $allow_trade . ' ;');
			$data['Transaction']['trade_title'] = $trade_result[0]['books']['title'];
			$data['Transaction']['trade_author'] = $trade_result[0]['books']['author'];
			$data['Transaction']['trade_isbn'] = $trade_result[0]['books']['ISBN'];
			$data['Transaction']['trade_image'] = $trade_result[0]['books']['image'];
		}


		$this->set('search_title', $search_title);
		$this->set('search_author', $search_author);
		$this->set('search_isbn', $search_isbn);

		/* Create an entry in the transactions table with the correct information */
		//Make sure there is not already a transaction between 2 people about the same book.
		$add_status = false;
		$duplicate = $this->Transaction->query('SELECT *
												FROM transactions
												WHERE client_id = ' . $client_id . '
												AND owner_id = ' . $owner_id . '
												AND status  = 0
												AND book_id = ' . $book_id . ';');

		if(!empty($duplicate)){
			$current_id = $duplicate[0]['transactions']['current_id'];
			$current_user = $this->Transaction->query('SELECT * FROM users WHERE facebook_id = ' . $current_id . ' ;');
			$data['Transaction']['current_name'] = $current_user[0]['users']['name'];
		}else{
			$add_status = true;
			//Add new tuple in the transaction table to track this transaction
			$this->Transaction->query('INSERT INTO transactions(owner_id, client_id, book_id, current_id, trade_id, duration, price, status, deleted, created)
													VALUES(' . $owner_id. ',' . $this->Session->read('uid') . ',' . $book_id . ',' . $owner_id . ', -1,' . $duration . ',' . $price .', 0, -1, NOW());');

			$data['Transaction']['current_name'] = $data['Transaction']['owner_name'];
		}
		
		
		$this->set('data', $data);


  }

	function accept_transaction($book_id = null, $owner_id = null, $price = "NULL", $duration = "NULL", $client_id = "NULL", $allow_trade = -1) {
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Library || My Transactions');

		//Get book and owner result back from database
		$book_result = $this->Transaction->query('SELECT * FROM books WHERE id = ' . $book_id . ' ;');
		$owner_result = $this->Transaction->query('SELECT * FROM users WHERE facebook_id = ' . $owner_id . ' ;');

		$data['Transaction']['allow_trade'] = $allow_trade;
		if($allow_trade > 0 && $duration == "NULL" && $price == "NULL"){
			//Get info about the book to be traded
			$trade_result = $this->Transaction->query('SELECT * FROM books WHERE id = ' . $allow_trade . ' ;');
			$data['Transaction']['trade_title'] = $trade_result[0]['books']['title'];
			$data['Transaction']['trade_author'] = $trade_result[0]['books']['author'];
			$data['Transaction']['trade_isbn'] = $trade_result[0]['books']['ISBN'];
			$data['Transaction']['trade_image'] = $trade_result[0]['books']['image'];

			//A trade has occurred; swap books in users libraries.
			$this->Transaction->query('DELETE FROM book_initial_offers
									WHERE user_id = ' . $owner_id . '
										AND book_id = ' . $book_id . ';');

			$this->Transaction->query('DELETE FROM book_initial_offers
									WHERE user_id = ' . $client_id . '
										AND book_id = ' . $allow_trade . ';');

			$this->Transaction->query('INSERT INTO book_initial_offers VALUES (' . $owner_id .
																				','  . $allow_trade .
																				',-1' .
																				',NULL' .
																				',NULL' .
																				', NOW(), NULL);');

			$this->Transaction->query('INSERT INTO book_initial_offers VALUES (' . $client_id .
																				','  . $book_id .
																				',-1' .
																				',NULL' .
																				',NULL' .
																				', NOW(), NULL);');

		}

		/* This statement updates the status of this transaction to "completed" state */
		$this->Transaction->query('UPDATE transactions
									SET status = 1
									WHERE owner_id = ' . $owner_id . '
										AND client_id = ' . $client_id . '
										AND book_id = ' . $book_id . '
										AND status = 0;');

		if ($duration != "NULL") {
			date_default_timezone_set('UTC');
			$curr_date = date('Y-m-j H:i:s');
			$date = new DateTime($curr_date);
			date_add($date, date_interval_create_from_date_string($duration . ' days'));
			$due_date = date_format($date, 'Y-m-d H:i:s');
			$this->Transaction->query('INSERT INTO loans(owner_id, client_id, book_id, due_date, created)
									VALUES(' . $owner_id . ', ' . $client_id . ', ' . $book_id . ', \'' . $due_date . '\', NOW());');
		}

		// remove from book initial offers
		if ($duration == "NULL" && $allow_trade <= 0 && $price != "NULL") {
			$this->Transaction->query('DELETE FROM book_initial_offers
									WHERE user_id = ' . $owner_id . '
										AND book_id = ' . $book_id . ';');
										
			$this->Transaction->query('INSERT INTO book_initial_offers VALUES (' . $client_id .
																				','  . $book_id .
																				',-1' .
																				',NULL' .
																				',NULL' .
																				', NOW(), NULL);');							
		
										
		}

		// remove all other pending transactions on this book
		$this->Transaction->query('DELETE FROM transactions
									WHERE book_id = ' . $book_id . '
										AND owner_id = ' . $owner_id . '
										AND status != 1;');

		$data['Transaction']['book_title'] = $book_result[0]['books']['title'];
		$data['Transaction']['book_id'] = $book_id;
		$data['Transaction']['owner_name'] = $owner_result[0]['users']['name'];
		$data['Transaction']['owner_id'] = $owner_id;
		$data['Transaction']['book_author'] = $book_result[0]['books']['author'];
		$data['Transaction']['book_isbn'] = $book_result[0]['books']['ISBN'];
		$data['Transaction']['book_image'] = $book_result[0]['books']['image'];

		$data['Transaction']['price'] = $price;
		$data['Transaction']['duration'] = $duration;
		$data['Transaction']['client_id'] = $client_id;

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

		//Get client user id, get their name.
		$size = sizeof($transaction_collection);
		for($i=0; $i < $size; $i++){
			$client_id = $transaction_collection[$i]['t']['client_id'];
			$client_result = $this->Transaction->query('SELECT * FROM users WHERE facebook_id = ' . $client_id . ' ;');
			$transaction_collection[$i]['client_name'] = $client_result[0]['users']['name'];
		}

		//pass variables to page
		$this->set('transaction_collection', $transaction_collection);
		//debug($transaction_collection);
	}


    //Pre: Called from counter_transaction.ctp, performs posting of a new offer or counteroffer
	//Post: Modifies transactions table to update the transaction to latest state, displays offer details.
   function make_offer(){

		//For CSS
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Library || My Transactions');

		//Get data from the previous view's form post
		$book_title = $this->data['Transaction']['book_title'];
		$book_id = $this->data['Transaction']['book_id'];
		$owner_name = $this->data['Transaction']['owner_name'];
		$owner_id = $this->data['Transaction']['owner_id'];
		$book_author = $this->data['Transaction']['book_author'];
		$book_isbn = $this->data['Transaction']['book_isbn'];
		$book_image = $this->data['Transaction']['book_image'];
		$client_id = $this->data['Transaction']['client_id'];

		//If loan was specified in the offer, display it
		$duration = "NULL";
		if (isset($this->data['Transaction']['offer_loan']) && $this->data['Transaction']['offer_loan'] == "loan") {
			$duration = $this->data['Transaction']['loan_duration'];
		}

		//If buy was specified in the offer, display it
		$price = "NULL";
		if (isset($this->data['Transaction']['offer_sell']) && $this->data['Transaction']['offer_sell'] == "sell") {
			$price = $this->data['Transaction']['sell_price'];
		}

		//If trade was specifed in the offer, display the book that was offered in trade
		if (isset($this->data['Transaction']['offer_trade']) && $this->data['Transaction']['offer_trade'] == "trade") {
			$trade_id = $this->data['Transaction']['trade_id'];

			//Update tuple to have trade_id

			//Get the details about the book offered in trade from the database
			$book_result = $this->Transaction->query('SELECT * FROM books WHERE id = ' . $trade_id . ' ;');
			$trade_title = $book_result[0]['books']['title'];
			$trade_author = $book_result[0]['books']['author'];
			$trade_isbn = $book_result[0]['books']['ISBN'];
			$trade_image = $book_result[0]['books']['image'];

			$this->set('trade_title', $trade_title);
			$this->set('trade_author', $trade_author);
			$this->set('trade_isbn', $trade_isbn);
			$this->set('trade_image', $trade_image);
		}

		//Make data available in the view
		$this->set('book_title', $book_title);
		$this->set('book_id', $book_id);
		$this->set('owner_name', $owner_name);
		$this->set('owner_id', $owner_id);
		$this->set('book_author', $book_author);
		$this->set('book_isbn', $book_isbn);
		$this->set('book_image', $book_image);
		$this->set('price', $price);
		$this->set('duration', $duration);
		if(isset($trade_id)){
			$this->set('trade_id', $trade_id);
		}


		//Need to update the transaction tuple with the new values
		
		if(!isset($trade_id)){
			$trade_id = -1;
		}
		
		
		$this->Transaction->query('UPDATE transactions
									SET current_id = '. $this->Session->read('uid') .',
										trade_id = '. $trade_id .',
										duration = '. $duration .',
										price = '. $price .' '.'
									WHERE owner_id = ' . $owner_id . '
										AND client_id = ' . $client_id . '
										AND book_id = ' . $book_id . '
										AND status = 0;');
  }

  function confirm_transaction($book_id = null, $owner_id = null, $client_id = "NULL",  $allow_trade = 0, $offer_option = null, $price = "NULL", $duration = "NULL") {

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

		$data['Transaction']['allow_trade'] = $allow_trade;
		if($allow_trade > 0){
			//Get info about the book to be traded
			$trade_result = $this->Transaction->query('SELECT * FROM books WHERE id = ' . $allow_trade . ' ;');
			$data['Transaction']['trade_title'] = $trade_result[0]['books']['title'];
			$data['Transaction']['trade_author'] = $trade_result[0]['books']['author'];
			$data['Transaction']['trade_isbn'] = $trade_result[0]['books']['ISBN'];
			$data['Transaction']['trade_image'] = $trade_result[0]['books']['image'];
		}

		$data['Transaction']['book_title'] = $book_result[0]['books']['title'];
		$data['Transaction']['book_id'] = $book_id;
		$data['Transaction']['owner_name'] = $owner_result[0]['users']['name'];
		$data['Transaction']['owner_id'] = $owner_id;
		$data['Transaction']['book_author'] = $book_result[0]['books']['author'];
		$data['Transaction']['book_isbn'] = $book_result[0]['books']['ISBN'];
		$data['Transaction']['book_image'] = $book_result[0]['books']['image'];

		$data['Transaction']['price'] = $price;
		$data['Transaction']['duration'] = $duration;
		$data['Transaction']['client_id'] = $client_id;
		$data['Transaction']['allow_trade'] = $allow_trade;

		$this->set('data', $data);
  }
  
/*
	PRE: This function displays the deletion confirmation page delete_transaction.ctp. It is called from the my_transactions.ctp page to remove a transaction from the history. This function requires that the status of the transaction is either complete or canceled.
	POST: If the user confirms then control is transfered to remove_transaction. If the user cancels then then the user is taken back to my_transactions.ctp.  	
*/ 
	function delete_transaction($tid, $bid, $price, $loan, $trade){
		//set the layout
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Library || My Transactions');
		//get the book information to display to the user
		$book_array = $this->Transaction->query("SELECT * FROM books WHERE id = " . $bid);
		//get the name of the owner of the book for this transaction
		$name_array = $this->Transaction->query("SELECT name FROM users u, transactions t WHERE t.id = " . $tid . " AND t.owner_id = u.facebook_id");
		$name = $name_array[0]["u"]["name"];
		//send everything to the view
		$this->set('tid', $tid);
		$this->set('name', $name);
		$this->set('book_array', $book_array);
		$this->set('price', $price);
		$this->set('loan', $loan);
		$this->set('trade', $trade);
	}

/*
	PRE: This function is transfered to by delete_transaction.ctp if the user clicks to confirm deleting the transaction.
	POST: The deleted attribute of the transactions table is checked. If it is -1, the users facebook_id is inserted and they will no longer see the transaction in my_transactions.ctp. If the deleted attribute already contains somebdies facebook_id, then the tuple is removed from the transactions table.  	
*/ 
	function remove_transaction($tid){
		//check deleted attribute
		$transaction_array = $this->Transaction->query("SELECT deleted FROM transactions WHERE id = " . $tid);
		$deleted = $transaction_array[0]["transactions"]["deleted"];
		//if deleted is -1, add users facebook_id, otherwise remove tuple
		if($deleted == -1){
			$this->Transaction->query("UPDATE transactions SET deleted = " . $this->Session->read('uid') . " WHERE id = " . $tid);
		} else {
			$this->Transaction->query("DELETE FROM transactions WHERE id = " . $tid);
		}
		$this->redirect('/transactions/my_transactions/');
	}



	//Pre: Called from the transaction.ctp view, allows user to make a new/updated offer on a book
	//Post: Accepts user input in a form, submits to make_offer.ctp
    function counter_transaction($book_id = null, $owner_id = null, $allow_trade = 0, $client_id = "NULL") {

		//For CSS Styling
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Library || My Transactions');


		//Use parameters to get other important informationg about the book at the center of the transactions
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
		$data['Transaction']['client_id'] = $client_id;




		// This should be in the counteroffer page.
		if (true){
			$trade_books = $this->Transaction->query('SELECT books.*
				FROM book_initial_offers b_i_o, books books
				WHERE b_i_o.user_id = ' . $this->Session->read('uid') . '
					AND b_i_o.trade_id = 0
					AND b_i_o.book_id = books.id;');
			# debug($trade_books);
			$data['Transaction']['trade_books'] = $trade_books;
		}
		//Make all of data available to the view
		$this->set('data', $data);

    }

}
?>
