<!--
File: /app/views/transaction.ctp
 
	Created: 5/19/2011
	Author: James Parsons
	
	Changelog:
	5/19/2011 - James Parsons - Created page and basic functionality
	
	# This is the view for the add books form.
-->
<head>
<?php echo $this->Html->css('main', NULL, array('inline' => FALSE)); ?>
<?php echo $this->Html->css('transactions', NULL, array('inline' => FALSE)); ?>
</head>

<body>

<h2>Your Offer Has Been Successfully Made!</h2>

<div>

	<fieldset style="border: 3px solid #000000">
			<legend><h4> <?= $owner_name ?>'s Book:</h4> </legend>
			<p class="book_display">
				<label >
					<img src=<?= $book_image ?> alt="Book image" />
					<strong>Title:</strong>	<?= $book_title ?> <br />
					<strong>Author(s):</strong> <?= $book_author ?> <br />
					<strong>ISBN:</strong> <?= $book_isbn ?> <br />
				</label>
			</p>
	</fieldset>


	<fieldset style="border: 3px solid #000000">
			<legend><h4>The Details of Your Offers: </h4></legend>
			<p>
			<?php
			
				if(!empty($duration) && $duration <> "NULL"){		
					echo '<strong> You propose to borrow for ' . $duration . ' days. </strong></br>';
				}
				
				if(!empty($price) && $price <> "NULL"){		
					echo '<strong> You propose to buy for $' . $price . '</strong></br>';
				}
				
				if(!empty($trade_id) && $trade_id <> -1){	
						//Display the book that will be traded for
						?>
						<fieldset style="border: 3px solid #000000">
								<legend><strong>You propose this book as a trade:</strong></legend>
								<p class="book_display">
									<label >
										<img src=<?= $trade_image ?> alt="Book image" />
										<strong>Title:</strong>	<?= $trade_title ?> <br />
										<strong>Author(s):</strong> <?= $trade_author ?> <br />
										<strong>ISBN:</strong> <?= $trade_isbn ?> <br />
									</label>
								</p>
						</fieldset>
						<?php
				}
			
			?>
			</p>
	</fieldset>

</div>

<div>
		<?php echo $this->Html->link('Click to go to your library', "/book_initial_offers/my_books/".$this->Session->read('uid'), array('class' => 'tab', 'escape' => false)); ?>
</div>

</body>
