<!-- File: /app/controllers/book_initial_offers_controller.php -->

<!--
	Created: 5/8/2011
	Author: James Parsons

	Changelog:
	5/8/2011 - James Parsons - Created page, added add_books_confirm().
	5/9/2011 - James Parsons - Created initial_offer_details().
	5/11/2011 - James Parsons - Created
-->

<?php
class BookInitialOffersController extends AppController {
   var $name = 'BookInitialOffers';


   function initial_offer_details(){

		//Get the book info for the book that was selected on the add books results page
		$book_chosen = explode( "^" , $this->data['Book']['book_type'] );
		$this->set('book_chosen', $book_chosen);

		// These lines enable our main layout to appear on the page.
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'initial_of_details');

	}

	function my_books(){
		//get user id
		//set layout (top and side bars) and title
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'My Books');
		//pull books and initial offers from the databaxe
		$book_collection = $this->BookInitialOffer->query("SELECT * FROM books, book_initial_offers WHERE books.id = book_initial_offers.book_id AND user_id = ".$this->Session->read('uid'));
		$size = sizeof($book_collection);
		$trade_books = NULL;
		//get books for trade for each initial offer
		for($i = 0; $i < $size; $i++){
			if(!is_null($book_collection[$i]["book_initial_offers"]["trade_id"])){
				$trade_books[$i]= $this->BookInitialOffer->query("SELECT * FROM books, trades WHERE books.id = trades.book_id AND trades.id = " . $book_collection[$i]["book_initial_offers"]["trade_id"]);
			}else{
				$trade_books[$i] = NULL;
			}
		}
		//pass variables to page
		$this->set('book_collection', $book_collection);
		$this->set('trade_books', $trade_books);
	}
	//confirmation page called when selecting remove from my library page
	function remove_confirm($bid){
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'My Books');
		$offer = $this->BookInitialOffer->query("SELECT * FROM books, book_initial_offers WHERE books.id = book_initial_offers.book_id AND book_initial_offers.user_id = " . $this->Session->read('uid')." AND book_initial_offers.book_id =" .$bid);
		$this->set('offer', $offer);
	}

	//REMOVES ENTRIES FROM THE DATABASE called by remove link from remove_comfirm page
	function remove($bid){
		//get trade id
		$trades = $this->BookInitialOffer->query("SELECT trade_id FROM book_initial_offers WHERE book_initial_offers.user_id = " . $this->Session->read('uid'). " AND book_initial_offers.book_id = " . $bid);
		$tid = $trades[0]["book_initial_offer"]["trade_id"];
		//remove row from book_initial_offers
		$this->BookInitialOffer->query("DELETE book_initial_offers FROM book_initial_offers WHERE book_initial_offers.user_id = " . $this->Session->read('uid') . " AND book_initial_offers.book_id = " . $bid);
		//if tid is not null remove all related trade rows
		if(!is_null($tid)){
			$this->BookInitialOffer->query("DELETE trades FROM trades WHERE trades.id = ". $tid);
		}
		//redirect to my_book page
		$this->redirect('/book_initial_offers/my_books/');
	}
	//this function is not yet implemented It will allow you to edit initial offers
	function edit (){
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Coming Soon');
	}

   //Called when user presses 'Add Book to My Library' on the initial_offer_details.ctp page, and redirects to the add_books_confirm.ctp page.
   function add_books_confirm() {

		// These lines enable our main layout to appear on the page.
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'initial_of_details');

		// Get book info passed from initial_offer_details
		$title = $this->data['BookInitialOffer']['title'];
		$author = $this->data['BookInitialOffer']['author'];
		$ISBN = $this->data['BookInitialOffer']['ISBN'];
		$image = $this->data['BookInitialOffer']['image'];

		// Make book info available in the view
		$this->set('title', $title);
		$this->set('author', $author);
		$this->set('ISBN', $ISBN);
		$this->set('image', $image);


		if (!empty($this->data)) {


			$offer_type = $this->data['BookInitialOffer']['offer_type'];

			switch ($offer_type) {
				case 'loan':
					$offer_value = $this->data['BookInitialOffer']['loan_duration'];
					break;
				case 'sell':
					$offer_value = $this->data['BookInitialOffer']['sell_price'];
					break;
				case 'trade':
					$offer_value = $this->data['BookInitialOffer']['trade_id'];
					break;
			}


			$this->set('offer_type', $offer_type);
			$this->set('offer_value', $offer_value);

		}
	}

	function add_book_to_mylibrary(){

		// These lines enable our main layout to appear on the page.
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'initial_of_details');

		//Retrieve values passed from form on previous page
		$book_title = $this->data['BookInitialOffer']['title'];
		$book_author = $this->data['BookInitialOffer']['author'];
		$book_isbn = $this->data['BookInitialOffer']['ISBN'];
		$book_image = $this->data['BookInitialOffer']['image'];
		$offer_type = $this->data['BookInitialOffer']['offer_type'];
		$offer_value = $this->data['BookInitialOffer']['offer_value'];

		//Make the values also available in the view
	    $this->set('title', $book_title);
		$this->set('author', $book_author);
		$this->set('ISBN', $book_isbn);
		$this->set('image', $book_image);
		$this->set('offer_type', $offer_type);
		$this->set('offer_value', $offer_value);

		$add_status = false;

		// Test to see if user is logged in
		/* if(is_null($this->Session->read('uid'))){
			echo "<h2> Please login to Facebook to add a book to your library.</h2>";
		}else{

			//Check our books table to see if the book is already in the database
			$book_results = $this->BookInitialOffer->query('SELECT * FROM books WHERE title ="' . $book_title . '" AND author ="' . $book_author . '" AND isbn = "' .  $book_isbn . '";');
			if(empty($book_results)){
				//Add book to our database
				$this->BookInitialOffer->query('INSERT INTO books(title, author, ISBN, image, summary, created) VALUES("' . $book_title . '","' . $book_author . '",' . $book_isbn . ',"' . $book_image . '", "dummy description", NOW());');
			}

			//Get book id from our database
			sleep(1);
			$the_book = $this->BookInitialOffer->query('SELECT * FROM books WHERE title ="' . $book_title . '" AND author ="' . $book_author . '" AND isbn = "' .  $book_isbn . '";');

			$book_id = 0;
			foreach ($the_book as $book){
				$result = $book['books'];
				$book_id = $result['id'];
			}

			//Test to see if user/book combo already exists; if so, do not attempt to add it again
			$duplicate = $this->BookInitialOffer->query('SELECT * FROM book_initial_offers WHERE user_id = ' . $this->Session->read('uid') . ' AND book_id =' . $book_id . ';');
			if(!empty($duplicate)){
				echo "<h2> You cannot add the same book to your library twice. </h2>";
			}else{

				$add_status = true;

				//Add book with offer to database, with the approprate fields filled in the tuple (loan vs. trade vs. sell)
				switch ($offer_type) {
						case 'loan':
							$this->BookInitialOffer->query('INSERT INTO book_initial_offers VALUES (' . $this->Session->read('uid') . ','  . $book_id . ',NULL,' . $offer_value . ', NULL, NOW(), NULL);');
							break;
						case 'sell':
							$this->BookInitialOffer->query('INSERT INTO book_initial_offers VALUES (' . $this->Session->read('uid') .','  . $book_id . ', NULL, NULL,' . $offer_value . ', NOW(), NULL);');
							break;
						case 'trade':
							$this->BookInitialOffer->query('INSERT INTO book_initial_offers VALUES (' . $this->Session->read('uid') .','  . $book_id . ',' . $offer_value . ', NULL, NULL, NOW(), NULL);');
							break;
				}
			}
		} */
		
		
		
		if(is_null($this->Session->read('uid'))){
					echo "<h2> Please login to Facebook to add a book to your library.</h2>";
		}else{
				//If the book exists alread in table books, then get it's book_id. Otherwise add it to the books table, and then get it's book_id.
				$book_id = 0;
				$book_results = $this->BookInitialOffer->query('SELECT * FROM books WHERE title ="' . $book_title . '" AND author ="' . $book_author . '" AND isbn = "' .  $book_isbn . '";');
				if(empty($book_results)){
					//Add book to our database
					$the_book = $this->BookInitialOffer->query('SELECT MAX(id) FROM books;');
					$this->BookInitialOffer->query('INSERT INTO books(id, title, author, ISBN, image, summary, created) VALUES("' . $book_id . '","' . $book_title . '","' . $book_author . '","' . $book_isbn . '","' . $book_image . '", "dummy description", NOW());');
				} else {
					foreach ($book_results as $book){
						$result = $book['books'];
						$book_id = $result['id'];
					}
				}

				//Test to see if user/book combo already exists; if so, do not attempt to add it again
				$duplicate = $this->BookInitialOffer->query('SELECT * FROM book_initial_offers WHERE user_id = ' . $this->Session->read('uid') . ' AND book_id =' . $book_id . ';');
				debug($duplicate);
				if(!empty($duplicate)){
					echo "<h2> You cannot add the same book to your library twice. </h2>";
				}else{

					$add_status = true;

					//Add book with offer to database, with the approprate fields filled in the tuple (loan vs. trade vs. sell)
					switch ($offer_type) {
							case 'loan':
								$this->BookInitialOffer->query('INSERT INTO book_initial_offers VALUES (' . $this->Session->read('uid') . ','  . $book_id . ',NULL,' . $offer_value . ', NULL, NOW(), NULL);');
								break;
							case 'sell':
								$this->BookInitialOffer->query('INSERT INTO book_initial_offers VALUES (' . $this->Session->read('uid') .','  . $book_id . ', NULL, NULL,' . $offer_value . ', NOW(), NULL);');
								break;
							case 'trade':
								$this->BookInitialOffer->query('INSERT INTO book_initial_offers VALUES (' . $this->Session->read('uid') .','  . $book_id . ',' . $offer_value . ', NULL, NULL, NOW(), NULL);');
								break;
					}
				}
			}
		$this->set('add_status', $add_status);
	}

} //End of add_book_to_mylibrary()
?>
