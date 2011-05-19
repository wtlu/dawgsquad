<?php echo $this->Html->css('transaction', NULL, array('inline' => FALSE)); ?>

<div>

	<h2> Transaction Accepted! </h2>

	<br />
	
	<p>Congratulations, you have a completed a transaction! Please use Facebook's private messaging system to
	make an exchange. Final transaction details are as follows:</p>
	
	<br />
	
	<fieldset>
		<legend> Book Offer </legend>
		<p class="book_display">
			<label >
				<img src=<?= $book_image ?> alt="Book image" />
				<strong>Title:</strong>	<?= $book_title ?> <br />
				<strong>Author(s):</strong> <?= $book_author ?> <br />
				<strong>ISBN:</strong> <?= $book_isbn ?> <br />
			</label>
		</p>
	</fieldset>
	
	<fieldset>
		<legend> Owner Information </legend>
		<p>
			<label >
				<strong>Name:</strong>	<?= $owner_name ?> <br />
			</label>
		</p>
	</fieldset>


	<fieldset>
		<legend> Selected Offer Details </legend>
		<p>
		<?php
		
			if(!empty($duration)){		
				echo '<strong> Loan for ' . $duration .' days. </strong></br>';
			}
			
			if(!empty($price)){		
				echo '<strong> For Sale at $' . $price .'</strong></br>';
			}
			
			if(!empty($allow_trade)){		
				echo '<strong> Some trade book here. </strong></br>';
			}
		
		?>
		</p>
	</fieldset>
	
</div>