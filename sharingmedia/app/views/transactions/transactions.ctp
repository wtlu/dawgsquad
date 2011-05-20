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
				<img src=<?= $data['Transaction']['book_image'] ?> alt="Book image" />
				<strong>Title:</strong>	<?= $data['Transaction']['book_title'] ?> <br />
				<strong>Author(s):</strong> <?= $data['Transaction']['book_author'] ?> <br />
				<strong>ISBN:</strong> <?= $data['Transaction']['book_isbn'] ?> <br />
			</label>
		</p>
</fieldset>

<div>
<p> <?= $data['Transaction']['owner_name'] ?> has offered the following options for obtaining this book. Please select one, or
create a counter-offer. </p>


<?php
	echo $form->create('Transaction', array('name' => 'offer_form', 'action' => 'confirm_transaction', 'type'=>'post'));
	if (isset($data['Transaction']['price']) && ("NULL" <> $data['Transaction']['price'])) {
	?>
		<input id="buy" type="radio" name="data[Transaction][offer_options]" value="price" onClick = "javascript:document.offer_form.accept_button.disabled=false"> <strong>Buy</strong> - Price: $<?= $data['Transaction']['price'] ?><br>
		<input name="data[Transaction][price]" id="price" value="<?= $price ?>" type="hidden">
	<?php
	}
	if (isset($data['Transaction']['duration']) && ("NULL" <> $data['Transaction']['duration'])) {
	?>
		<input id="loan" type="radio" name="data[Transaction][offer_options]" value="loan" onClick = "javascript:document.offer_form.accept_button.disabled=false"> <strong>Rent</strong> - Duration: <?= $data['Transaction']['duration'] ?> days<br>
		<input name="data[Transaction][duration]" id="duration" value="<?= $duration ?>" type="hidden">
	<?php
	}
	if (isset($data['Transaction']['allow_trade']) && ("NULL" <> $data['Transaction']['allow_trade'])) {
	?>
		<!-- <input type="radio" name="trade" value="t"> -->
		<strong>Trade:</strong><p>If you wish to trade a book, proceed with Counter Transaction.</p>
		<br>
	
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
		<input name="data[Transaction][book_title]" id="book_title" value="<?= $data['Transaction']['book_title'] ?>" type="hidden">
		<input name="data[Transaction][book_id]" id="book_id" value="<?= $data['Transaction']['book_id']  ?>" type="hidden">
		<input name="data[Transaction][owner_id]" id="owner_id" value="<?= $data['Transaction']['owner_id'] ?>" type="hidden">
		<input name="data[Transaction][owner_name]" id="owner_name" value="<?= $data['Transaction']['owner_name']  ?>" type="hidden">
		<input name="data[Transaction][book_author]" id="book_author" value="<?= $data['Transaction']['book_author']  ?>" type="hidden">
		<input name="data[Transaction][book_isbn]" id="book_isbn" value="<?= $data['Transaction']['book_isbn']  ?>" type="hidden">
		<input name="data[Transaction][book_image]" id="book_image" value="<?= $data['Transaction']['book_image']  ?>" type="hidden">	
		
	<input name = 'accept_button' type="submit" value="Accept" disabled = "disabled">
	<?php
	// Pass relevant information to counter_transaction.ctp if the user clicks the link.																						
	echo $this->Html->link('Counter Transaction', array( 'escape' => true, 'action' => 'counter_transaction', $data['Transaction']['book_title'],
																							$data['Transaction']['book_id'],
																							$data['Transaction']['owner_id'],
																							$data['Transaction']['owner_name'],
																							$data['Transaction']['book_author'],
																							$data['Transaction']['book_isbn'],
																							$data['Transaction']['book_image'],
																							$data['Transaction']['allow_trade']));
	?>

</div>

</body>
