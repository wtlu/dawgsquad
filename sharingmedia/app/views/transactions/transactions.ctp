<!--
File: /app/views/transaction.ctp
 
	Created: 5/12/2011
	Author: John Wang
	
	Changelog:
	5/12/2011 - John Wang - Added a message to display that this is coming soon
	5/16/2011 - John Wang - Displays transaction details
	
	# This is the view for the add books form.
-->
<head>
<?php echo $this->Html->css('main', NULL, array('inline' => FALSE)); ?>
<?php echo $this->Html->css('transactions', NULL, array('inline' => FALSE)); ?>
</head>

<body>

<fieldset style="border: 3px solid #000000">
		<legend> Book Available </legend>
		<p class="book_display">
			<label >
				<img src=<?php echo $book_image ?> alt="Book image" />
				<strong>Title:</strong>	<?php echo $book_title; ?> <br />
				<strong>Author(s):</strong> <?php echo $book_author ?> <br />
				<strong>ISBN:</strong> <?php echo $book_isbn ?> <br />
			</label>
		</p>
</fieldset>

<div>
<p> <?= $owner_name ?> has offered the following options for obtaining this book. Please select one, or
create a counter-offer. </p>


<?php
	echo $form->create('Transaction', array('action' => 'accept_transaction', 'type'=>'post'));
	if (isset($price) && ("NULL" <> $price)) {
	?>
		<input id="buy" type="radio" name="offer_options" value="<?= $price ?>"> <strong>Buy</strong> - Price: $<?= $price ?><br>
	<?php
	}
	if (isset($duration) && ("NULL" <> $duration)) {
	?>
		<input id="loan" type="radio" name="offer_options" value="<?= $duration ?>"> <strong>Rent</strong> - Duration: <?= $duration ?> days<br>
	<?php
	}
	
	/* Since this page is only displayed after the user clicks "Start Transaction" from find books results page,
	   there will not be any info to dispaly, because the initial offer details does not include specific books.
	   This code should be in the counter_offer page, and also the ongoing_transaction.ctp page. */
	/*
	if (isset($allow_trade) && ("NULL" <> $allow_trade)) {
	?>
		<!-- <input type="radio" name="trade" value="t"> -->
		<strong>Trade</strong><br>
		<p>Select the book you want to trade:</p>
		<div class="trade_list">
	<?php
		foreach ($trade_books as $tradeable){
			# echo $form->create('Users', array('action' => 'coming_soon', 'type'=>'post'));
			?>
			<input type="radio" name="trade" value="t" style="margin:10px">
			<?php
			display_results($tradeable['books']);
		}
	}

	*/
	?>
		<input name="data[Transaction][book_title]" id="book_title" value="<?php echo $book_title ?>" type="hidden">
		<input name="data[Transaction][book_id]" id="book_id" value="<?php echo $book_id ?>" type="hidden">
		<input name="data[Transaction][owner_id]" id="owner_id" value="<?php echo $owner_id ?>" type="hidden">
		<input name="data[Transaction][owner_name]" id="owner_name" value="<?php echo $owner_name ?>" type="hidden">
		<input name="data[Transaction][book_author]" id="book_author" value="<?php echo $book_author ?>" type="hidden">
		<input name="data[Transaction][book_isbn]" id="book_isbn" value="<?php echo $book_isbn ?>" type="hidden">
		<input name="data[Transaction][book_image]" id="book_image" value="<?php echo $book_image ?>" type="hidden">	
		<input name="data[Transaction][price]" id="book_image" value="<?php echo $price ?>" type="hidden">
		<input name="data[Transaction][duration]" id="book_image" value="<?php echo $duration ?>" type="hidden">

		<!-- </div> -->
	
	<?php
	echo $this->Form->end('Accept');
	
	echo $form->create('Transaction', array('action' => 'counter_transaction', 'type'=>'post'));
	?>
		<input name="data[Transaction][book_title]" id="book_title" value="<?php echo $book_title ?>" type="hidden">
		<input name="data[Transaction][book_id]" id="book_id" value="<?php echo $book_id ?>" type="hidden">
		<input name="data[Transaction][owner_id]" id="owner_id" value="<?php echo $owner_id ?>" type="hidden">
		<input name="data[Transaction][owner_name]" id="owner_name" value="<?php echo $owner_name ?>" type="hidden">
		<input name="data[Transaction][book_author]" id="book_author" value="<?php echo $book_author ?>" type="hidden">
		<input name="data[Transaction][book_isbn]" id="book_isbn" value="<?php echo $book_isbn ?>" type="hidden">
		<input name="data[Transaction][book_image]" id="book_image" value="<?php echo $book_image ?>" type="hidden">
		<input name="data[Transaction][allow_trade]" id="allow_trade" value="<?php echo $allow_trade ?>" type="hidden">
	<?php
	echo $this->Form->end('Counter Transaction');
	
?>

</div>

</body>
