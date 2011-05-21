<!--
File: /app/views/transaction.ctp
 
	Created: 5/12/2011
	Author: John Wang
	
	Changelog:
	5/16/2011 - John Wang - Added coming soon stuff
	5/17/2011 - James Parsons - Added functionality for selecting books from your library to trade. Updated how parameters are recieved.
	5/19/2011 - James Parsons - Properly displays possible trades from your the correct users mylibrary.
	
	# This is the view for the add books form.
-->
<?php echo $this->Html->css('main', NULL, array('inline' => FALSE)); ?>
<?php echo $this->Html->css('transactions', NULL, array('inline' => FALSE)); ?>



<!-- This displays the book details for the book that the user is trying to aquire -->
<fieldset style="border: 3px solid #000000">
		<legend> The Book You Are Making An Offer For:</legend>
		<p class="book_display">
			<label >
				<img src=<?= $data['Transaction']['book_image'] ?> alt="Book image" />
				<strong>Title:</strong>	<?= $data['Transaction']['book_title'] ?> <br />
				<strong>Author(s):</strong> <?= $data['Transaction']['book_author']?> <br />
				<strong>ISBN:</strong> <?= $data['Transaction']['book_isbn']?> <br />
			</label>
		</p>
</fieldset>

<fieldset >

<legend>Counter Offer Details</legend>

<div id="outer_container">

	<p>
	Please select the counter offer to propose. You can specify a loan duration in days, a price in dollars, or if you are willing to consider other books to trade.
	</p>

	
	<?php echo $form->create('Transaction', array('action' => 'make_offer', 'type'=>'post')); ?>
		
		<!-- Hidden fields, to transfer data to next page -->
		<input name="data[Transaction][book_title]" id="book_title" value="<?= $data['Transaction']['book_title'] ?>" type="hidden">
		<input name="data[Transaction][book_id]" id="book_id" value="<?= $data['Transaction']['book_id'] ?>" type="hidden">
		<input name="data[Transaction][book_author]" id="book_author" value="<?= $data['Transaction']['book_author'] ?>" type="hidden">
		<input name="data[Transaction][book_isbn]" id="book_isbn" value="<?= $data['Transaction']['book_isbn'] ?>" type="hidden">
		<input name="data[Transaction][book_image]" id="book_image" value="<?= $data['Transaction']['book_image'] ?>" type="hidden">
		<input name="data[Transaction][owner_id]" id="owner_id" value="<?= $data['Transaction']['owner_id'] ?>" type="hidden">
		<input name="data[Transaction][owner_name]" id="owner_name" value="<?= $data['Transaction']['owner_name'] ?>" type="hidden">
		<input name="data[Transaction][client_id]" id="client_id" value="<?= $data['Transaction']['client_id'] ?>" type="hidden">
		
		<!-- Input for the loan -->
		<div class="options">	
			<input name="data[Transaction][offer_loan]" id="choose_loan" value="loan" type="checkbox">
			<label for="choose_loan">Loan For</label>
			<?php
				echo $this->Form->input('loan_duration', array('label' => '', 'maxlength' => '6'));
			?>
		</div>
	
		
		<!-- Input for the buy -->
		<div class="options">	
			<input name="data[Transaction][offer_sell]" id="choose_sell" value="sell" type="checkbox">
			<label for="choose_sell">Sell For</label>
			<?php
				echo $this->Form->input('sell_price', array('label' => '', 'maxlength' => '6'));
			?>
		</div>

		
		<!-- Input for the trade book -->
		<div class="options_trades">
			<input name="data[Transaction][offer_trade]" id="choose_trade" value="trade" type="checkbox"">
			<label for="choose_trade">Books you own, that you could offer in trade:</label>
			<?php
				if (isset($data['Transaction']['allow_trade']) && ("NULL" <> $data['Transaction']['allow_trade'])) {
					?>
						<!-- <input type="radio" name="trade" value="t"> -->
					<div class="trade_list">
					<?php
						//If there is at least 1 book in the current users library
						//that is available to be traded
						if(!empty($data['Transaction']['trade_books'])){
							//Display all tradeable books as options for the offer proposal
							foreach ($data['Transaction']['trade_books'] as $tradeable){
								echo '<input type="radio" name="trade_option" value="' . $tradeable . '" /> ';
								display_results($tradeable);
								echo '<br />';	
							}
						}
					}
					?>
					</div>
			
			<div class="button_s">
				<?php echo $this->Form->end('Propose Counteroffer'); ?>
			</div>
		</div>
		


	

		
		
		
</div>
</fieldset>


<?php
# helper function to display trade book options
function display_results($result) {

	?>
	<div class="book_results_display">
	
		
		<input name="data[Transaction][trade_id]" id="trade_id" value="<?= $result['books']['id'] ?>" type="hidden">
		
		
		<label for="choose_book">
			<?php
				$title = $result['books']['title'];
				$author = $result['books']['author']; 
				$ISBN = $result['books']['ISBN']; 
				$image = $result['books']['image'];
				$summary = $result['books']['summary']; 
			?>
		<img width=100 src=<?= $image ?> alt="Book image" />
		<div class = "book_results_text">
			<strong>Title:</strong>	<?= $title ?> <br />
			<strong>Author(s):</strong> <?= $author ?> <br />
			<strong>Summary:</strong> <?= $summary ?> <br />
			<strong>ISBN:</strong> <?= $ISBN ?> <br />
		</div>
		</label>
	</div>
	<?php
}
?>

