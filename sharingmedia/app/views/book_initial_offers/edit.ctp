<?php echo $this->Html->css('library', NULL, array('inline' => FALSE)); ?>
<div id ="offer">
	<fieldset>
	<legend style="color:black;">Original Offer</legend>
	<div class="book_results_display">
			<img src=<?php echo $image ?> alt="Book image" />
			<strong>Title:</strong> <?php echo $title; ?> <br />
			<strong>Author(s):</strong> <?php echo $author ?> <br />
		<?php if(!is_null($price)){?>
			<strong>Price:</strong> $<?php echo $price?> <br />
		<?php }if(!is_null($loan)){?>
			<strong>Loan:</strong> <?php echo $loan?> days <br />
		<?php }if(!is_null($trade)){?>
			<strong>Trade:</strong> Willing to trade <br />
		<?php } ?>

	</div>
	</fieldset>

	<fieldset >

	<legend style="color:black;">New Offer</legend>

	<div id="outer_area">

			<p>
			Please select the new intitial offer that will be listed in your library, for other users to consider when they want your book. You can specify a loan duration in days, a price in dollars, or if you are willing to consider other books in trade. Please enter
			</p>

			
			<?php echo $form->create('BookInitialOffer', array('action' => 'edit_comfirm', 'type'=>'post')); ?>
			<!--Hidden fields to pass data-->	  
			<input name="data[BookInitialOffer][title]" id="title" value="<?php echo $title ?>" type="hidden">
			<input name="data[BookInitialOffer][author]" id="author" value="<?php echo $author ?>" type="hidden">
			<input name="data[BookInitialOffer][bid]" id="bid" value="<?php echo $bid ?>" type="hidden">
			<input name="data[BookInitialOffer][image]" id="image" value="<?php echo $image ?>" type="hidden">
					
			<div class="options">  
				<input name="data[BookInitialOffer][offer_loan]" id="choose_loan" value="loan" type="checkbox">
					<label for="choose_loan">Loan For</label>
					<?php
						echo $this->Form->input('loan_duration', array('label' => '', 'class'=>'field', 'maxlength' => '6'));
					?>
			</div>

			<div class="options">
				<input name="data[BookInitialOffer][offer_sell]" id="choose_sell" value="sell" type="checkbox">
				<label for="choose_sell">Sell For</label>
			<?php
						echo $this->Form->input('sell_price', array('label' => '', 'class'=>'field', 'maxlength' => '6'));
					?>
			 </div>
			 <div class="options">
					<input name="data[BookInitialOffer][offer_trade]" id="choose_trade" value="trade" type="checkbox">
					<label id="special" for="choose_trade">Willing to consider trades?</label>
					</div>
					<?php
							echo $this->Form->end('Update Offer');
							echo $this->Html->link('Cancel', "/book_initial_offers/my_books", array(' escape' => false));
					?>
		</div>
	</fieldset>
</div>


