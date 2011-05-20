<!-- File: /app/views/book_initial_offers/initial_offer_details.ctp -->

<!--
	Created: 5/8/2011
	Author: James Parsons
	
	Changelog:
	5/8/2011 - James Parsons - Created form for input of initial offer details, with submit to add_books_confirm.
	5/11/2011 - James Parsons - Now displays book info passed from add book results page.
-->

<?php echo $this->Html->css('initial_offers', NULL, array('inline' => FALSE)); ?>

<div class="top_progress_arrows">
	<?php echo $this->Html->image('arrow_choose_offer_details.png', array('alt' => 'book info')) ?>
</div>

<fieldset>
<p class="book_results_display">
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

<div id="outer_area">

	<p>
	Please select the intitial offer that will be listed in your library, for other users to consider when they want your book. You can specify a loan duration in days, a price in dollars, or if you are willing to consider other books in trade.
	</p>

	
	<?php echo $form->create('BookInitialOffer', array('action' => 'add_books_confirm', 'type'=>'post')); ?>
		
	
		
		<!-- Hidden fields, to transfer data to next page -->
		<input name="data[BookInitialOffer][title]" id="title" value="<?php echo $title ?>" type="hidden">
		<input name="data[BookInitialOffer][author]" id="author" value="<?php echo $author ?>" type="hidden">
		<input name="data[BookInitialOffer][ISBN]" id="ISBN" value="<?php echo $ISBN ?>" type="hidden">
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
			echo $this->Form->end('Add To MyLibrary');
		?>
		<FORM METHOD="LINK" ACTION="http://apps.facebook.com/sharingmedia/books/add_books">
		<INPUT class = "special_button" TYPE="submit" VALUE="Cancel and do a new search">
		</FORM>

		
		
		
</div>
</fieldset>

