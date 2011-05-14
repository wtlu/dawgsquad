<!-- File: /app/views/book_initial_offers/initial_offer_details.ctp -->

<!--
	Created: 5/8/2011
	Author: James Parsons
	
	Changelog:
	5/8/2011 - James Parsons - Created form for input of initial offer details, with submit to add_books_confirm.
	5/11/2011 - James Parsons - Now displays book info passed from add book results page.
-->


<?php echo $this->Html->css('main', NULL, array('inline' => FALSE)); ?>



<fieldset>
<p class="book_display">
<label >
		<?php
			$title = $book_chosen[1];
			$author = $book_chosen[2];
			$ISBN = $book_chosen[3];
			$image = $book_chosen[4];	
		?>
	<img src=<?php echo $image ?> alt="Book image" />
	<strong>Title:</strong>	<?php echo $title; ?> <br />
	<strong>Author(s):</strong> <?php echo $author ?> <br />
	<strong>ISBN:</strong> <?php echo $ISBN ?> <br />
</label>
</p>
</fieldset>

<fieldset >

<legend style="color:black;">Add Initial Offer Details</legend>

<div style="width:300px; align:center;">

	

	</br>
	</br>
	
	<?php echo $form->create('BookInitialOffer', array('action' => 'add_books_confirm', 'type'=>'post')); ?>
		
	
		<hr>
		<!-- Hidden fields, to transfer data to next page -->
		<input name="data[BookInitialOffer][title]" id="title" value="<?php echo $title ?>" type="hidden">
		<input name="data[BookInitialOffer][author]" id="author" value="<?php echo $author ?>" type="hidden">
		<input name="data[BookInitialOffer][ISBN]" id="ISBN" value="<?php echo $ISBN ?>" type="hidden">
		<input name="data[BookInitialOffer][image]" id="image" value="<?php echo $image ?>" type="hidden">
		
		<input name="data[BookInitialOffer][offer_type]" id="choose_loan" value="loan" type="radio" style="width:50px; float:left;">
		<label for="choose_loan" style="float:left">Loan For</label>
		<?php
			echo $this->Form->input('loan_duration', array('label' => '', 'style' => 'width:100px; float:right;', 'maxlength' => '6'));
		?>

		
		</br>
		<hr>
		</br>
		
		<input name="data[BookInitialOffer][offer_type]" id="choose_sell" value="sell" type="radio" style="width:50px; float:left;>
		<label for="choose_sell">Sell For</label>
		<?php
			echo $this->Form->input('sell_price', array('label' => '', 'style' => 'width:100px; float:right;', 'maxlength' => '6'));
		?>

		</br>
		<hr>
		</br>
		
		<input name="data[BookInitialOffer][offer_type]" id="choose_trade" value="trade" type="radio" style="width:50px; float:left;>
		<label for="choose_trade">Trade For</label>
		<?php
			echo $this->Form->input('trade_id', array('label' => '', 'type' => 'text', 'style' => 'width:100px; float:right;', 'maxlength' => '6'));
		?>
		
		</br>
		<hr>

		<?php
			echo $this->Form->end('Add To MyLibrary');
		?>
		
		
		<?php  
			#echo $this->Form->button('Go Back', array('onClick' => 'window.location.back()'));
		?>
		
		
		
</div>
</fieldset>

