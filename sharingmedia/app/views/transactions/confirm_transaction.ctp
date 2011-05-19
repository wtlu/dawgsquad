<?php echo $this->Html->css('transaction', NULL, array('inline' => FALSE)); ?>

<div>

	<h2> Confirm Transaction </h2>

	</br>
	
	<p>You're almost done! Review the transaction details below, then click Complete Transaction to accept this
	transaction.</p>
	
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

<?php echo $form->create('Transaction', array('action' => 'accept_transaction', 'type'=>'post')); ?>
		<!-- Hidden fields, to transfer data to next page -->
		<input name="data[Transaction][book_title]" id="title" value="<?php echo $book_title ?>" type="hidden">
		<input name="data[Transaction][book_author]" id="author" value="<?php echo $book_author ?>" type="hidden">
		<input name="data[Transaction][book_isbn]" id="ISBN" value="<?php echo $book_isbn ?>" type="hidden">
		<input name="data[Transaction][book_image]" id="image" value="<?php echo $book_image ?>" type="hidden">
		
		
		<?php
		if(!empty($duration)){		
				echo '<input name="data[Transaction][duration]" id="ld" value="' . $duration . '" type="hidden">';
		}
		
		if(!empty($price)){		
				echo '<input name="data[Transaction][price]" id="sp" value="' . $price . '" type="hidden">';
		}
		
		if(!empty($trade_id)){		
				echo '<input name="data[Transaction][trade_id]" id="ti" value="' . $trade_id . '" type="hidden">';
		}
		?>

<?php
	echo $this->Form->end('Complete Transaction!');
?>