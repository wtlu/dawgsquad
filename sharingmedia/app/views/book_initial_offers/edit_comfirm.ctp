<?php echo $this->Html->css('library', NULL, array('inline' => FALSE)); ?>
<div id ="book_display">
	<fieldset>
		<legend> Your Book </legend>
		<div class="book_display">
			<img src=<?php echo $image ?> alt="Book image" />
			<ul id="book_info">
				<li><strong>Title:</strong>	<?php echo $title; ?> </li>
				<li><strong>Author(s):</strong> <?php echo $author ?> </li>
			</ul>
		</div>
	</fieldset>
	<fieldset>
		<legend> New Offer Details </legend>
		<div class = "new_offer">
		<ul class="offer_details">
		<?php
			if($loan_duration!=("NULL")){?>
				 <li>Loan Duration:  <?php echo $loan_duration?> days </li>;
		<?php }
			if($sell_price!=("NULL")){?>
				<li>For Sale at $ <?php echo  $sell_price ?></li> 
		<?php	}
			if(!empty($trade_id)){?>
				 <li> Willing to Trade for Another Book</li>
		<?php	}
		?>
			</ul>
		</div>
		
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
