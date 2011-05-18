<!--
File: /app/views/transaction.ctp
 
	Created: 5/12/2011
	Author: John Wang
	
	Changelog:
	5/16/2011 - John Wang - Added coming soon stuff
	
	# This is the view for the add books form.
-->
<?php echo $this->Html->css('transaction', NULL, array('inline' => FALSE)); ?>

<fieldset style="border: 3px solid #000000">
		<legend> The Book You Are Making An Offer For:</legend>
		<p class="book_display">
			<label >
				<img src=<?php echo $book_image ?> alt="Book image" />
				<strong>Title:</strong>	<?php echo $book_title; ?> <br />
				<strong>Author(s):</strong> <?php echo $book_author ?> <br />
				<strong>ISBN:</strong> <?php echo $book_isbn ?> <br />
			</label>
		</p>
</fieldset>

<fieldset >

<legend>Counter Offer Details</legend>


<div id="outer_container">

	<p>
	Please select the counter offer to propose. You can specify a loan duration in days, a price in dollars, or if you are willing to consider other books to trade.
	</p>

	
	<?php echo $form->create('Transaction', array('action' => 'accept_transaction', 'type'=>'post')); ?>
		
	
		<hr>
		<!-- Hidden fields, to transfer data to next page -->
		<input name="data[Transaction][book_title]" id="book_title" value="<?php echo $book_title ?>" type="hidden">
		<!--
		<input name="data[Transaction][author]" id="author" value="<?php echo $author ?>" type="hidden">
		<input name="data[Transaction][ISBN]" id="ISBN" value="<?php echo $ISBN ?>" type="hidden">
		<input name="data[Transaction][image]" id="image" value="<?php echo $image ?>" type="hidden">
		-->
		
		<input name="data[Transaction][offer_loan]" id="choose_loan" value="loan" type="checkbox" style="width:50px; float:left;">
		<label for="choose_loan" style="float:left">Loan For</label>
		<?php
			echo $this->Form->input('loan_duration', array('label' => '', 'style' => 'width:100px; float:right;', 'maxlength' => '6'));
		?>

		
		</br>
		<hr>
		</br>
		
		<input name="data[Transaction][offer_sell]" id="choose_sell" value="sell" type="checkbox" style="width:50px; float:left;">
		<label for="choose_sell">Sell For</label>
		<?php
			echo $this->Form->input('sell_price', array('label' => '', 'style' => 'width:100px; float:right;', 'maxlength' => '6'));
		?>

		</br>
		<hr>
		</br>
		
		<input name="data[Transaction][offer_trade]" id="choose_trade" value="trade" type="checkbox" style="width:50px; float:left;">
		<label for="choose_trade">Willing to consider trades?</label>
		<?php
			//echo $this->Form->input('trade_id', array('label' => '', 'type' => 'text', 'style' => 'width:100px; float:right;', 'maxlength' => '6'));
		?>
		
		</br>
		<hr>

		<?php
			echo $this->Form->end('Propose Counteroffer');
		?>

		
		
		
</div>
</fieldset>

