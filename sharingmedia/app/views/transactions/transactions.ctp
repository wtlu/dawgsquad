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
<h1> Item Available: <?= $book_title ?> </h1>

<div>
<p> <?= $user_name ?> has offered the following options for obtaining this book. Please select one, or
create a counter-offer. </p>

<?php
	echo $form->create('Transactions', array('action' => 'accept_transaction', 'type'=>'post'));
	if (isset($price)) {
	?>
		<input type="radio" name="buy" value="b"> <strong>Buy</strong> - Price: $<?= $price ?><br>
	<?php
	}
	if (isset($duration)) {
	?>
		<input type="radio" name="rent" value="r"> <strong>Rent</strong> - Duration: <?= $duration ?> days<br>
	<?php
	}
	if (isset($allow_trade)) {
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
	?>
		</div>
	<?php
	echo $this->Form->end('Accept');
	
	echo $form->create('Transactions', array('action' => 'counter_transaction', 'type'=>'post'));
	echo $this->Form->end('Counter Transaction');
	
?>

</div>

</body>

<?php
# helper function to display trade book results
function display_results($result) {
	$chosen = '';
	# build the string of book data and pass on to initial_offer_details function in book initial offers controller
	foreach ($result as $element) {
		$chosen = $chosen . '^' . $element;
	}
	?>
	<div class="book_results_display">
	
		<!--
		<input name="data[Book][book_type]" id="choose_book" value="<?= $chosen ?>" type="hidden">
		-->
		
		<label for="choose_book">
			<?php
				$title = $result['title'];
				$author = $result['author'];
				$ISBN = $result['ISBN'];
				$image = $result['image'];
				$summary = $result['summary'];
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