<?php echo $this->Html->css('library', NULL, array('inline' => FALSE)); ?>
<div id ="book_display">
	<fieldset>
		<legend> Your Book </legend>
		<div class="book_display">
			<img class="display_book" src=<?php echo $image ?> alt="Book image" />
			<ul class="book_info">
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
				 <li>Loan Duration:  <?php echo $loan_duration?> days </li>
		<?php }
			if($sell_price!=("NULL")){?>
				<li>For Sale at $ <?php echo  $sell_price ?></li> 
		<?php	}
			if($trade_id == 0){?>
				 <li> Willing to Trade for Another Book</li>
		<?php	}
		?>
			</ul>
		</div>
		
		<?php echo $form->create('BookInitialOffer', array('action' => 'update/'.$this->Session->read('uid')."/".$bid, 'type'=>'post')); ?>
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
	echo $this->Html->link('Cancel', "/book_initial_offers/edit/".$this->Session->read('uid')."/".$bid, array(' escape' => false));
?>
	</fieldset>
