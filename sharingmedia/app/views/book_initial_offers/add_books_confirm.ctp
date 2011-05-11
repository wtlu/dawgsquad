<!-- File: /app/views/book_initial_offers/add_books_confirm.ctp -->

<!--
	Created: 5/8/2011
	Author: James Parsons
	
	Changelog:
	5/8/2011 - James Parsons - Created page, added functionality to print offer details, TODO: write SQL to allow adding new tuple to book_initial_offer on confirm press.
-->



<?php echo $this->Html->css('main'); ?>

<strong>Display Title, Author, ISBN, Picture Here</strong>
</br>
</br>


<?php
	if (!empty($offer_type)) {
		
		switch ($offer_type) {
				case 'loan':
					echo '<strong> Initial Desired Offer: Loan for ' . $offer_value .' days. </strong>';
					break;
				case 'sell':
					echo '<strong> Initial Desired Offer: For Sale at $' . $offer_value .'</strong>';
					break;
				case 'trade':
					echo '<strong> Initial Desired Offer: Trade for ' . $offer_value .' </strong>';
					break;
			}
		
	} else {
		echo 'error';
	}
?>

<!--
$book_results = $this->Book->query('SELECT * FROM books WHERE title LIKE "%' . $book_title . '%" AND author LIKE "%' . $book_author . '%" AND isbn LIKE "%' .  $book_isbn . '%";');
$this->set('book_results', $book_results);
-->