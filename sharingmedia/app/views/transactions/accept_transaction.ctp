<!--
File: /app/views/accept_transaction.ctp
 
	Created: 5/12/2011
	Author: John Wang
	
	Changelog:
	5/12/2011 - John Wang - Added a message to display that this is coming soon
	
	# This is the view for the add books form.
-->
<head>
<?php echo $this->Html->css('main', NULL, array('inline' => FALSE)); ?>
</head>

<body>
<h1> Item Available: <?= $book_title ?> </h1>

<div>
<p> <?= $user_name ?> has offered the following options for obtaining this book. Please select one, or
create a counter-offer. </p>

<?php
	echo $form->create('Transactions', array('action' => 'confirm_transaction', 'type'=>'post'));
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
		<input type="radio" name="trade" value="t"> <strong>Trade</strong><br>
	<?php
	}
	echo $this->Form->end('Accept');
	
?>

</div>

</body>