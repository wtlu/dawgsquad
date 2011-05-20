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

<div>

	<fieldset style="border: 3px solid #000000">
			<legend> Book Available </legend>
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
			<legend> Selected Offer Details </legend>
			<p>
			<?php
			
				if(!empty($duration)){		
					echo '<strong> You propose to borrow for ' . $duration . ' days. </strong></br>';
				}
				
				if(!empty($price)){		
					echo '<strong> You propose to buy for $' . $price . '</strong></br>';
				}
				
				if(!empty($trade_id)){	
						//Display the book that will be traded for
						$book_result = $this->Transaction->query('SELECT * FROM books WHERE id = ' . $trade_id . ' ;');
						$temp_title = $book_result[0]['books']['title'];
						$temp_author = $book_result[0]['books']['author'];
						$temp_isbn = $book_result[0]['books']['ISBN'];
						$temp_image = $book_result[0]['books']['image'];

						
						<fieldset style="border: 3px solid #000000">
								<legend>You propose this book as a trade</legend>
								<p class="book_display">
									<label >
										<img src=<?= $temp_image ?> alt="Book image" />
										<strong>Title:</strong>	<?= $temp_title ?> <br />
										<strong>Author(s):</strong> <?= $temp_author ?> <br />
										<strong>ISBN:</strong> <?= $temp_isbn ?> <br />
									</label>
								</p>
						</fieldset>

				
					echo '<strong> Trade for Another Book ' . $trade_id .' </strong></br>';
				}
			
			?>
			</p>
	</fieldset>

</div>

</body>