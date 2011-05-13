<!-- File: /app/views/book_initial_offers/add_books_confirm.ctp -->

<!--
	Created: 5/8/2011
	Author: James Parsons
	
	Changelog:
	5/8/2011 - James Parsons - Created page, added functionality to print offer details, TODO: write SQL to allow adding new tuple to book_initial_offer on confirm press.
	5/11/2011 - James Parsons - Added ability to recieve book info from calling page, and display the book.
-->

<?php echo $this->Html->css('main', NULL, array('inline' => FALSE)); ?>

<div>

	<h2> Confirm Selection </h2>

	</br>
	
	<fieldset style="border: 3px solid #000000">
		<legend> Your Book </legend>
		<p class="book_display">
			<label >
				<img src=<?php echo $image ?> alt="Book image" />
				<strong>Title:</strong>	<?php echo $title; ?> <br />
				<strong>Author(s):</strong> <?php echo $author ?> <br />
				<strong>ISBN:</strong> <?php echo $ISBN ?> <br />
			</label>
		</p>
	</fieldset>


	<fieldset style="border: 3px solid #000000">
		<legend> Selected Offer Details </legend>
		<p>
		<?php
			if (!empty($offer_type)) {
				
				switch ($offer_type) {
						case 'loan':
							echo '<strong> Loan for ' . $offer_value .' days. </strong>';
							break;
						case 'sell':
							echo '<strong> For Sale at $' . $offer_value .'</strong>';
							break;
						case 'trade':
							echo '<strong> Trade for ' . $offer_value .' </strong>';
							break;
					}
				
			} else {
				echo 'error';
			}
		?>
		</p>
	</fieldset>
	
</div>

<?php echo $form->create('BookInitialOffer', array('action' => 'add_book_to_mylibrary', 'type'=>'post')); ?>
		<!-- Hidden fields, to transfer data to next page -->
		<input name="data[BookInitialOffer][title]" id="title" value="<?php echo $title ?>" type="hidden">
		<input name="data[BookInitialOffer][author]" id="author" value="<?php echo $author ?>" type="hidden">
		<input name="data[BookInitialOffer][ISBN]" id="ISBN" value="<?php echo $ISBN ?>" type="hidden">
		<input name="data[BookInitialOffer][image]" id="image" value="<?php echo $image ?>" type="hidden">
		<input name="data[BookInitialOffer][offer_type]" id="image" value="<?php echo $offer_type ?>" type="hidden">
		<input name="data[BookInitialOffer][offer_value]" id="image" value="<?php echo $offer_value ?>" type="hidden">
<?php
	echo $this->Form->end('Confirm Add To MyLibrary');
?>

