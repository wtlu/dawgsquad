<!-- File: /app/views/book_initial_offers/add_book_to_mylibrary.ctp -->

<!--
	Created: 5/11/2011
	Author: James Parsons

	Changelog:
	5/11/2011 - James Parsons - Created page, as a receipt style confirmation after the book has been added to mylibrary.
-->

<?php echo $this->Html->css('main', NULL, array('inline' => FALSE)); ?>

<div>

	<?php
		if($add_status){
			echo '<h2> Add Book Successful!</h2>';
		}else{
			echo '<h2> Add Unsuccessful</h2>';
		}
	?>
	</br>

	<fieldset>
		<legend> Your Book </legend>
		<p class = "book_display">
			<label>
				<img src=<?php echo $image ?> alt="Book image" />
				<strong>Title:</strong>	<?php echo $title; ?> <br />
				<strong>Author(s):</strong> <?php echo $author ?> <br />
				<strong>ISBN:</strong> <?php echo $ISBN ?> <br />
			</label>
		</p>
	</fieldset>


	<fieldset>
		<legend> Selected Offer Details </legend>
		<p>
		<?php

			if(!empty($loan_duration)){
				echo '<strong> Loan for ' . $loan_duration . ' days. </strong><br />';
			}

			if(!empty($sell_price)){
				echo '<strong> For Sale at $' . $sell_price . '. </strong><br />';
			}

			if(!empty($trade_id)){
				echo '<strong> Willing to Trade for Another Book. </strong><br />';
			}
			
			if(empty($loan_duration) && empty($sell_price) && empty($trade_id)){
				echo '<strong> No Initial Offer Details Were Selected. </strong><br />';
			}

		?>
		</p>
	</fieldset>
	<div>
		<?php echo $this->Html->link('Click to go to your library', "/book_initial_offers/my_books", array('class' => 'tab', 'escape' => false)); ?>
	</div>
</div>