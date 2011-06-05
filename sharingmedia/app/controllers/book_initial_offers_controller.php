<!-- File: /app/controllers/book_initial_offers_controller.php -->

<!--
	Created: 5/8/2011
	Author: James Parsons

	Changelog:
	5/8/2011 - James Parsons - Created page, added add_books_confirm().
	5/9/2011 - James Parsons - Created initial_offer_details().
	5/11/2011 - James Parsons - Created code to populate database with new books and new book initial offers.
	5/14/2011 - James Parsons - Added checks to database to ensure consistency, i.e. no duplicate entries will be created.
	5/15/2011 - James Parsons - Incorporated facebook id in order to correctly track owners of book initial offers.
-->

<?php

App::import('Sanitize');

class BookInitialOffersController extends AppController {
   var $name = 'BookInitialOffers';

   //Pre: This page was called from add_book_results.ctp, and given $book_chosen as a list of information about the chosen book
   //Post: Makes available the book information to initial_offer_details.ctp in the variable $book_chosen, which is an arry of strings.
   function initial_offer_details(){

		//Get the book info for the book that was selected on the add books results page
		$book_chosen_enc = urldecode($this->data['Book']['book_type']);
		$book_chosen = explode( "^" , $book_chosen_enc );
		$this->set('book_chosen', $book_chosen);

		// These lines enable our main layout to appear on the page.
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'initial_of_details');

	}

	//Pre: This page is the default page when a user navigates to their Library. takes uid of current user
	//post: Returns an array of all books listed by the user and  the offer details of each books

	function my_books($uid){
		//set layout (top and side bars) and title
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'My Books');
		//pull books and initial offers from the databaxe
		$book_collection = $this->BookInitialOffer->query("SELECT * FROM books, book_initial_offers WHERE books.id = book_initial_offers.book_id AND user_id = ".$uid ." ORDER BY books.title");
		//pass variables to page
		$this->set('book_collection', $book_collection);
	}
	//Pre: confirmation page called when selecting remove from my library page requires user id of current user and  book id of book to be removed
	//Post: returns an array of book details
	function remove_confirm($uid, $bid){
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'My Books');
		$offer = $this->BookInitialOffer->query("SELECT * FROM books, book_initial_offers WHERE books.id = book_initial_offers.book_id AND book_initial_offers.user_id = " . $uid." AND book_initial_offers.book_id =" .$bid);
		$this->set('offer', $offer);
	}

	//Pre: REMOVES ENTRIES FROM THE DATABASE called by remove link from remove_comfirm page required user id of currend user and book id of book to be removed
	//Post: book is removed from your library. user is redirected back to their library.
	function remove($uid, $bid){
		//get trade id
		//remove row from book_initial_offers
		$this->BookInitialOffer->query("DELETE book_initial_offers FROM book_initial_offers WHERE book_initial_offers.user_id = " . $uid . " AND book_initial_offers.book_id = " . $bid);
		//redirect to my_book page
		$this->redirect('/book_initial_offers/my_books/'.$uid);
	}
	//Pre: called when the user hit edit on the my library page. Requires user id of current user and a valid bid of the initial offer to be changed
	//Post: Sets title, author, image, and bid of the book, and loan duration, trade and price of current initial offer.
	function edit($uid, $bid){
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Change Offer');
		$offer = $this->BookInitialOffer->query("SELECT * FROM books, book_initial_offers WHERE books.id = book_initial_offers.book_id AND book_initial_offers.user_id = " . $uid." AND book_initial_offers.book_id =" .$bid);
		$this->set('title', $offer[0]["books"]["title"]);
		$this->set('author', $offer[0]["books"]["author"]);
		$this->set('image', $offer[0]["books"]["image"]);
		$this->set('loan', $offer[0]["book_initial_offers"]["duration"]);
		$this->set('price', $offer[0]["book_initial_offers"]["price"]);
		$this->set('trade', $offer[0]["book_initial_offers"]["trade_id"]);
		$this->set('bid', $bid);

	}
	//Pre: called when user hits change offer on edit page. requires Takes data from forms on the edit page paramaters are uid or current user and bid of book to edit offer for
	//Post: Sets title, author, image, and bid of the book, and loan duration, trade and price of new initial offer.
	function edit_comfirm($uid, $bid){
		//set title and defualt layout
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'Comfirm New Offer');

		//set book info
		$offer = $this->BookInitialOffer->query("SELECT * FROM books, book_initial_offers WHERE books.id = book_initial_offers.book_id AND book_initial_offers.user_id = " . $uid." AND book_initial_offers.book_id =" .$bid);
                $this->set('title', $offer[0]["books"]["title"]);
                $this->set('author', $offer[0]["books"]["author"]);
                $this->set('image', $offer[0]["books"]["image"]);
                $this->set('bid', $bid);

		//set new offer details
		if (!empty($this->data)) {
			if(!empty($this->data['BookInitialOffer']['offer_loan'])){
				$this->set('loan_duration', $this->data['BookInitialOffer']['loan_duration']);
			}else{
				$this->set('loan_duration', "NULL");
			}

			if(!empty($this->data['BookInitialOffer']['offer_sell'])){
				$this->set('sell_price', $this->data['BookInitialOffer']['sell_price']);
			}else{
				$this->set('sell_price', "NULL");
			}
			if(!empty($this->data['BookInitialOffer']['offer_trade'])){
				$this->set('trade_id', 0);
			} else{
				$this->set('trade_id', -1);
			}
		}
	}
	//Pre when user hits change offer on edit confirm page this controller is called. reads data from forms on page.
	//Post: Updates the book initial offere with data passed by forms and redirects to the users my books page
	function update($uid, $bid){
		$set = "SET";
			$set .= " trade_id = " . $this->data['BookInitialOffer']['trade_id'];
			$set .= ", duration = " .  $this->data['BookInitialOffer']['loan_duration'];
			$set .= ", price = " . $this->data['BookInitialOffer']['sell_price'];

			$this->BookInitialOffer->query("UPDATE book_initial_offers " . $set . " WHERE book_id = ".$bid . " AND user_id = ".$uid);
	$this->redirect('/book_initial_offers/my_books/'.$uid);
	}



   //Pre: Called when user presses 'Add Book to My Library' on the initial_offer_details.ctp page, and redirects to the add_books_confirm.ctp page.
   //Post: Makes data from the form on initial_offer_details.ctp available to add_boo_to_my_library.
   function add_books_confirm() {

		// These lines enable our main layout to appear on the page.
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'initial_of_details');

		// Get book info passed from initial_offer_details
		$title = $this->data['BookInitialOffer']['title'];
		$author = $this->data['BookInitialOffer']['author'];
		$ISBN = $this->data['BookInitialOffer']['ISBN'];
		$image = $this->data['BookInitialOffer']['image'];
		$summary = $this->data['BookInitialOffer']['summary'];

		// Make book info available in the view
		$this->set('title', $title);
		$this->set('author', $author);
		$this->set('ISBN', $ISBN);
		$this->set('image', $image);
		$this->set('summary', $summary);


		if (!empty($this->data)) {


			if(!empty($this->data['BookInitialOffer']['offer_loan'])){
				$loan_duration = $this->data['BookInitialOffer']['loan_duration'];
				$this->set('loan_duration', $loan_duration);
			}

			if(!empty($this->data['BookInitialOffer']['offer_sell'])){
				$sell_price = $this->data['BookInitialOffer']['sell_price'];
				$this->set('sell_price', $sell_price);
			}

			if(!empty($this->data['BookInitialOffer']['offer_trade'])){
				$trade_id = 0;
				$this->set('trade_id', $trade_id);
			} else{
				$this->set('trade_id', -1);
			}

		}
	}

	//Pre: Called when add_books_confirm.ctp redirects to add_book_to_mylibrary.ctp, given all information about book and offer details.
	//Post: If the book in question is not in the books table, it is added. If the user does not already have this book in their mylibrary,
	//		a new entry is added to book_initial_offers detailing which book they now have and its initial offer details. Appropriate error
	//		messages are displayed when these operations fail.
	function add_book_to_mylibrary($uid){

		// These lines enable our main layout to appear on the page.
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'initial_of_details');

		//Retrieve values passed from form on previous page
		$book_title = $this->data['BookInitialOffer']['title'];
		$book_author = $this->data['BookInitialOffer']['author'];
		$book_isbn = $this->data['BookInitialOffer']['ISBN'];
		$book_image = $this->data['BookInitialOffer']['image'];
		$book_summary = $this->data['BookInitialOffer']['summary'];

		$loan_duration = "NULL";
		$sell_price = "NULL";
		$trade_id = 0;

		if(!empty($this->data['BookInitialOffer']['loan_duration'])){
			$loan_duration = $this->data['BookInitialOffer']['loan_duration'];
			$this->set('loan_duration', $loan_duration);
		}

		if(!empty($this->data['BookInitialOffer']['sell_price'])){
			$sell_price = $this->data['BookInitialOffer']['sell_price'];
			$this->set('sell_price', $sell_price);
		}

		if(!empty($this->data['BookInitialOffer']['trade_id'])){
			$trade_id = $this->data['BookInitialOffer']['trade_id'];
			$this->set('trade_id', $trade_id);
		}


		//Make the values also available in the view
	    $this->set('title', $book_title);
		$this->set('author', $book_author);
		$this->set('ISBN', $book_isbn);
		$this->set('image', $book_image);
		$this->set('summary', $book_summary);

		//Keeps track of whether the book was added to users mylibrary; used to print message in the view
		$add_status = false;

		//Ensure that the user is logged in to Facebook.
		if(is_null($uid)){
					echo "<h2> Please login to Facebook to add a book to your library.</h2>";
		}else{

				//If the book exists alread in table books, then get it's book_id. Otherwise add it to the books table, and then get it's book_id.
				$book_id = 0;
				$book_results = $this->BookInitialOffer->query('SELECT * FROM books WHERE title ="' . $book_title . '" AND author ="' . $book_author . '" AND isbn = "' .  $book_isbn . '";');
				if(empty($book_results)){
					//Add book to our database
					$the_book = $this->BookInitialOffer->query('SELECT MAX(id) FROM books;');
					$book_id = $the_book[0][0]['MAX(id)'] + 1;
					$this->BookInitialOffer->query('INSERT INTO books(id, title, author, ISBN, image, summary, created) VALUES("' . $book_id . '","' . $book_title . '","' . $book_author . '","' . $book_isbn . '","' . $book_image . '","' . $book_summary . '", NOW());');
				} else {
					foreach ($book_results as $book){
						$result = $book['books'];
						$book_id = $result['id'];
					}
					$this->BookInitialOffer->query('UPDATE books SET summary = "'. $book_summary .'" WHERE id = "' . $book_id . '";');
				}

				//Test to see if user/book combo already exists; if so, do not attempt to add it again
				$duplicate = $this->BookInitialOffer->query('SELECT * FROM book_initial_offers WHERE user_id = ' . $uid . ' AND book_id =' . $book_id . ';');
				if(!empty($duplicate)){
					echo "<h2> You cannot add the same book to your library twice. </h2>";
				}else{

					$add_status = true;

					//Add book with offer to database, with the approprate fields filled in the tuple (loan vs. trade vs. sell)
					$this->BookInitialOffer->query('INSERT INTO book_initial_offers VALUES (' . $uid . ','  . $book_id . ',' . $trade_id . ',' . $loan_duration . ',' . $sell_price . ', NOW(), NULL);');
				}
			}
		$this->set('add_status', $add_status);

		$this->redirect('/book_initial_offers/my_books/'.$uid);
	}

} //End of add_book_to_mylibrary()
?>
