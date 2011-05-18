<?php echo $this->Html->css('transactions', NULL, array('inline' => FALSE)); ?>

<div>

	<h2> Confirm Transaction Details </h2>

	</br>
	
	<fieldset>
		<legend> Book Offer </legend>
		<p class="book_display">
			<label >
				<img src=<?php echo $image ?> alt="Book image" />
				<strong>Title:</strong>	<?php echo $title; ?> <br />
				<strong>Author(s):</strong> <?php echo $author ?> <br />
				<strong>ISBN:</strong> <?php echo $ISBN ?> <br />
			</label>
		</p>
	</fieldset>


	<fieldset>
		<legend> Selected Offer Details </legend>
		<p>
		<?php
		
			if(!empty($loan_duration)){		
				echo '<strong> Loan for ' . $loan_duration .' days. </strong></br>';
			}
			
			if(!empty($sell_price)){		
				echo '<strong> For Sale at $' . $sell_price .'</strong></br>';
			}
			
			if(!empty($trade_id)){		
				echo '<strong> Willing to Trade for Another Book. </strong></br>';
			}
		
		?>
		</p>
	</fieldset>
	
</div>

<?php echo $form->create('Transaction', array('action' => 'complete_transaction', 'type'=>'post')); ?>
		<!-- Hidden fields, to transfer data to next page -->
		<input name="data[Transaction][title]" id="title" value="<?php echo $title ?>" type="hidden">
		<input name="data[Transaction][author]" id="author" value="<?php echo $author ?>" type="hidden">
		<input name="data[Transaction][ISBN]" id="ISBN" value="<?php echo $ISBN ?>" type="hidden">
		<input name="data[Transaction][image]" id="image" value="<?php echo $image ?>" type="hidden">
		
		
		<?php
		if(!empty($loan_duration)){		
				echo '<input name="data[Transaction][loan_duration]" id="ld" value="' . $loan_duration . '" type="hidden">';
		}
		
		if(!empty($sell_price)){		
				echo '<input name="data[Transaction][sell_price]" id="sp" value="' . $sell_price . '" type="hidden">';
		}
		
		if(!empty($trade_id)){		
				echo '<input name="data[Transaction][trade_id]" id="ti" value="' . $trade_id . '" type="hidden">';
		}
		?>

<?php
	echo $this->Form->end('Confirm Transaction');
?>