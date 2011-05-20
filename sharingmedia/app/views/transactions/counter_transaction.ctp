<!--
File: /app/views/transaction.ctp
 
	Created: 5/12/2011
	Author: John Wang
	
	Changelog:
	5/16/2011 - John Wang - Added coming soon stuff
	
	# This is the view for the add books form.
-->
<?php echo $this->Html->css('main', NULL, array('inline' => FALSE)); ?>
<?php echo $this->Html->css('transactions', NULL, array('inline' => FALSE)); ?>

<fieldset style="border: 3px solid #000000">
		<legend> The Book You Are Making An Offer For:</legend>
		<p class="book_display">
			<label >
				<img src=<?= $data['Transaction']['book_image'] ?> alt="Book image" />
				<strong>Title:</strong>	<?= $data['Transaction']['book_title'] ?> <br />
				<strong>Author(s):</strong> <?= $data['Transaction']['book_author']?> <br />
				<strong>ISBN:</strong> <?= $data['Transaction']['book_isbn']?> <br />
			</label>
		</p>
</fieldset>

<fieldset >

<legend>Counter Offer Details</legend>


<div id="outer_container">

	<p>
	Please select the counter offer to propose. You can specify a loan duration in days, a price in dollars, or if you are willing to consider other books to trade.
	</p>

	
	<?php echo $form->create('Transaction', array('action' => 'make_offer', 'type'=>'post')); ?>
		
	
		<hr>
		<!-- Hidden fields, to transfer data to next page -->
		<!--
		<input name="data[Transaction][book_title]" id="book_title" value="<?php echo $book_title ?>" type="hidden">
		-->
		<!--
		<input name="data[Transaction][author]" id="author" value="<?php echo $author ?>" type="hidden">
		<input name="data[Transaction][ISBN]" id="ISBN" value="<?php echo $ISBN ?>" type="hidden">
		<input name="data[Transaction][image]" id="image" value="<?php echo $image ?>" type="hidden">
		-->
		
		<input name="data[Transaction][offer_loan]" id="choose_loan" value="loan" type="checkbox" style="width:50px; float:left;">
		<label for="choose_loan" style="float:left">Loan For</label>
		<?php
			echo $this->Form->input('loan_duration', array('label' => '', 'style' => 'width:100px; float:right;', 'maxlength' => '6'));
		?>

		
		</br>
		<hr>
		</br>
		
		<input name="data[Transaction][offer_sell]" id="choose_sell" value="sell" type="checkbox" style="width:50px; float:left;">
		<label for="choose_sell">Sell For</label>
		<?php
			echo $this->Form->input('sell_price', array('label' => '', 'style' => 'width:100px; float:right;', 'maxlength' => '6'));
		?>

		</br>
		<hr>
		</br>
		
		<input name="data[Transaction][offer_trade]" id="choose_trade" value="trade" type="checkbox" style="width:50px; float:left;">
		<label for="choose_trade">Books you own, that you could offer in trade:</label>
		<?php
			if (isset($data['Transaction']['allow_trade']) && ("NULL" <> $data['Transaction']['allow_trade'])) {
				?>
					<!-- <input type="radio" name="trade" value="t"> -->
				<div class="trade_list">
				<?php
					foreach ($data['Transaction']['trade_books'] as $tradeable){
						echo '<input type="radio" name="trade_option" value="' . $tradeable . '" /> ';
						display_results($tradeable);
						echo '<br />';
						
					}
				
				}
		?>
				</div>
		
		</br>
		<hr>

		<?php
			echo $this->Form->end('Propose Counteroffer');
		?>

		
		
		
</div>
</fieldset>


<?php
# helper function to display trade book results
function display_results($result) {
	$chosen = '';
	# build the string of book data and pass on to initial_offer_details function in book initial offers controller
	foreach ($result as $element) {
		$chosen = $chosen . '^' . $element;
	}
	?>
	<div class="book_results_display">
	
		<!--
		<input name="data[Book][book_type]" id="choose_book" value="<?= $chosen ?>" type="hidden">
		-->
		
		<label for="choose_book">
			<?php
				$title = $result['books']['title'];
				$author = $result['books']['author']; 
				$ISBN = $result['books']['ISBN']; 
				$image = $result['books']['image'];
				$summary = $result['books']['summary']; 
			?>
		<img width=100 src=<?= $image ?> alt="Book image" />
		<div class = "book_results_text">
			<strong>Title:</strong>	<?= $title ?> <br />
			<strong>Author(s):</strong> <?= $author ?> <br />
			<strong>Summary:</strong> <?= $summary ?> <br />
			<strong>ISBN:</strong> <?= $ISBN ?> <br />
		</div>
		</label>
	</div>
	<?php
}
?>

