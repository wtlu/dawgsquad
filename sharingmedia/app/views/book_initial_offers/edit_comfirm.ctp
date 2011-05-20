<?php echo $this->Html->css('library', NULL, array('inline' => FALSE)); ?>
<div id ="offer">
	<fieldset>
		<legend> Your Book </legend>
		<p class="book_display">
			<label >
				<img src=<?php echo $image ?> alt="Book image" />
				<strong>Title:</strong>	<?php echo $title; ?> <br />
				<strong>Author(s):</strong> <?php echo $author ?> <br />
			</label>
		</p>
	</fieldset>
	<fieldset>
		<legend> New Offer Details </legend>
		<p>
		<?php

			if(!empty($loan_duration)){
				echo '<strong> Loan for ' . $loan_duration .' days. </strong><br />';
			}

			if(!empty($sell_price)){
				echo '<strong> For Sale at $' . $sell_price .'. </strong><br />';
			}

			if(!empty($trade_id)){
				echo '<strong> Willing to Trade for Another Book. </strong><br />';
			}

		?>
		</p>
		
		<?php echo $form->create('BookInitialOffer', array('action' => 'update', 'type'=>'post')); ?>
		<!-- Hidden fields, to transfer data to next page -->
		<input name="data[BookInitialOffer][title]" id="title" value="<?php echo $title ?>" type="hidden">
		<input name="data[BookInitialOffer][author]" id="author" value="<?php echo $author ?>" type="hidden">
		<input name="data[BookInitialOffer][bid]" id="bid" value="<?php echo $bid ?>" type="hidden">
		<input name="data[BookInitialOffer][image]" id="image" value="<?php echo $image ?>" type="hidden">
		<?php
		if(!empty($loan_duration)){
				echo '<input name="data[BookInitialOffer][loan_duration]" id="ld" value="' . $loan_duration . '" type="hidden">';
		}

		if(!empty($sell_price)){
				echo '<input name="data[BookInitialOffer][sell_price]" id="sp" value="' . $sell_price . '" type="hidden">';
		}

		echo '<input name="data[BookInitialOffer][trade_id]" id="ti" value="' . $trade_id . '" type="hidden">';
		?>

<?php
	echo $this->Form->end('Comfirm Changes');
	echo $this->Html->link('Cancel', "/book_initial_offers/edit/"."/".$bid, array(' escape' => false));
?>
	</fieldset>
