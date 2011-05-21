<!--
File: /app/views/transaction.ctp

	Created: 5/12/2011
	Author: John Wang

	Changelog:
	5/12/2011 - John Wang - Added a message to display that this is coming soon
	5/16/2011 - John Wang - Displays transaction details
	5/18/2011 - John Wang - Started links to accept and counter
	5/20/2011 - John Wang - James Parsons - Finished links to accept and counter

	# This is the view for the add books form.
-->
<head>
<?php echo $this->Html->css('main', NULL, array('inline' => FALSE)); ?>
<?php echo $this->Html->css('transactions', NULL, array('inline' => FALSE)); ?>
</head>

<body>

	<?php
			if ($search_title != null || $search_author != null || $search_isbn != null) {
				echo $this->Form->create('Book', array('action' => 'find_books_results'));
				echo $this->Form->input('title', array('type' => 'hidden', 'value' => $search_title));
				echo $this->Form->input('author', array('type' => 'hidden', 'value' => $search_author));
				echo $this->Form->input('isbn', array('type' => 'hidden', 'value' => $search_isbn));
				echo $this->Form->end('Go Back to Results');
			}
	?>

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
<p> <?= $data['Transaction']['current_name'] ?> has offered the following options for obtaining this book. Please select one, or
create a counter-offer. </p>


<?php
	echo $form->create('Transaction', array('name' => 'offer_form', 'action' => 'confirm_transaction'."/".
																					$data['Transaction']['book_id']."/".
																					$data['Transaction']['owner_id']."/".
																					$data['Transaction']['client_id']."/".
																					$data['Transaction']['allow_trade']."/", 'type'=>'post'));
	if (isset($data['Transaction']['price']) && ("NULL" <> $data['Transaction']['price'])) {
	?>
		<input id="buy" type="radio" name="data[Transaction][offer_options]" value="price" onClick = "javascript:document.offer_form.accept_button.disabled=false"> <strong>Buy</strong> - Price: $<?= $data['Transaction']['price'] ?><br>
		<input name="data[Transaction][price]" id="price" value="<?= $price ?>" type="hidden">
	<?php
	}
	if (isset($data['Transaction']['duration']) && ("NULL" <> $data['Transaction']['duration'])) {
	?>
		<input id="loan" type="radio" name="data[Transaction][offer_options]" value="loan" onClick = "javascript:document.offer_form.accept_button.disabled=false"> <strong>Borrow</strong> - Duration: <?= $data['Transaction']['duration'] ?> days<br>
		<input name="data[Transaction][duration]" id="duration" value="<?= $duration ?>" type="hidden">
	<?php
	}
	if ($data['Transaction']['allow_trade'] > 0) {
	?>
		<!-- Need to display info about the book offered in trade. -->
		<fieldset style="border: 3px solid #000000">
		<legend> Use This Book In The Trade: </legend>
		<p class="book_display">
		<input id="trade" type="radio" name="data[Transaction][allow_trade]" value="<?= $allow_trade ?>" onClick = "javascript:document.offer_form.accept_button.disabled=false"> <br>
			<label >
				<img src=<?= $data['Transaction']['trade_image'] ?> alt="Book image" />
				<strong>Title:</strong>	<?= $data['Transaction']['trade_title'] ?> <br />
				<strong>Author(s):</strong> <?= $data['Transaction']['trade_author'] ?> <br />
				<strong>ISBN:</strong> <?= $data['Transaction']['trade_isbn'] ?> <br />
			</label>
		</p>
		</fieldset>



	<?php
	}
	?>

	<input name = 'accept_button' type="submit" value="Accept" disabled = "disabled">
	</form>
	<?php
	// Pass relevant information to counter_transaction.ctp if the user clicks the link.
	echo $this->Html->link('Counter Transaction', array('escape'=> false, 'action' => 'counter_transaction'."/".
																					$data['Transaction']['book_id']."/".
																					$data['Transaction']['owner_id']."/".
																					$data['Transaction']['allow_trade']."/".
																					$data['Transaction']['client_id']."/"));
	?>

</div>

</body>
