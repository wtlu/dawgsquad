<!-- File: /app/controllers/book_initial_offers_controller.php -->

<!--
	Created: 5/8/2011
	Author: James Parsons
	
	Changelog:
	5/8/2011 - James Parsons - Created page, added add_books_confirm().
-->

<?php
class BookInitialOffersController extends AppController {
   var $name = 'Book_Initial_Offers';
   
   
   function initial_offer_details(){
   
	}

	function my_books($uid){
		$book_collection = $this->Book_Inital_Offer->query("SELECT title, author, image, summary, FROM book_inital_offers AND books WHERE user_id = $uid AND books.id=book_id" );

		
	}   
   
   //Called when user presses 'Add Book to My Library' on the initial_offer_details.ctp page, and redirects to the add_books_confirm.ctp page.
   function add_books_confirm() {
		
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
   
}
?>
