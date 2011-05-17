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
<h1> Item Available: (book title) </h1>

<div>
<p> (owner) has offered the following options for obtaining this book. Please select one, or
create a counter-offer. </p>

<?php
	echo $form->create('Transactions', array('action' => 'confirm_transaction', 'type'=>'post'));
	?>
	<input type="radio" name="buy" value="b"> <strong>Buy</strong> - Price:<br>
	<input type="radio" name="rent" value="r"> <strong>Rent</strong> - Days:<br>
	<input type="radio" name="trade" value="t"> <strong>Trade</strong><br>
	<?php
	echo $this->Form->end('Accept');
	
?>

</div>

</body>