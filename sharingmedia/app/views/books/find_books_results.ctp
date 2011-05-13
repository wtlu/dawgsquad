<!-- File: /app/views/books/find_books_results.ctp -->

<!--
	Created: 5/10/2011
	Author: John Wang
	
	Changelog:
	5/10/2011 - John Wang - Created page. Copied relevant code from add books results
	5/11/2011 - John Wang -
	
	<?php echo $this->Html->css('main'); ?>
-->
<?php echo $this->Html->css('main', NULL, array('inline' => FALSE)); ?>
<?php echo $this->Html->css('book_results', NULL, array('inline' => FALSE)); ?>

<h2>Results:</h2>

<div class = "results_display">
<?php
	if (!empty($book_results)) {
		foreach ($book_results as $book){
			echo $form->create('Transactions', array('action' => 'accept_transaction', 'type'=>'post'));
			$result = $book['books'];
			$user_result = $book['users'];
			$b_i_o_result = $book['b_i_o'];
			$trade_book = array();
			if (array_key_exists('trade_book', $book)) {
				$trade_book = $book['trade_book'];
			}
			display_results($result, $user_result, $b_i_o_result, $trade_book);
			echo $this->Form->end('Start a Transaction');
		}
	} else {
		?>
		<p> No results. Please try your search again. </p>
		<?php
	}
	
	# echo $this->Form->end('Continue');
?>
</div>

<?php
#functions

function display_results($result, $user_result, $b_i_o_result, $trade_book) {
	?>
	<div class="book_results_display">
		<!--
		<input class="radio_button" name="data[Book][book_type]" id="choose_book" value="<?php echo $chosen ?>" type="radio" style="width:30px; float:left;">
		-->
		<label for="choose_book">
			<?php
				$title = $result['title'];
				$author = $result['author'];
				$ISBN = $result['ISBN'];
				$image = $result['image'];
				$summary = $result['summary'];
			?>
			<img src=<?php echo $image ?> alt="Book image" />
		<div class = "book_results_text">
				<strong>Title:</strong>	<?php echo $title ?> <br />
				<strong>Author(s):</strong> <?php echo $author ?> <br />
				<strong>Summary:</strong> <?php echo $summary ?> <br />
				<strong>ISBN:</strong> <?php echo $ISBN ?> <br />
			<h3> Owner </h3>
				<?php
					$name = $user_result['name'];
				?>
				<strong>Name:</strong>	<?php echo $name ?> <br />
			<h3> Offer Details </h3>
				<?php
					$price = $b_i_o_result['price'];
					$duration = $b_i_o_result['duration'];
					if (!empty($trade_book)) {
						$trade_title = $trade_book['title'];
						$trade_author = $trade_book['author'];
					}
				if (!empty($price)) {
				?>
				<strong>Price: $</strong><?php echo $price ?> <br />
				<?php
				}
				if (!empty($duration)) {
				?>
				<strong>Loan Duration:</strong> <?php echo $duration ?> days<br />
				<?php
				}
				if (!empty($trade_book)) {
				?>
				<strong>Willing to trade for:</strong> <i><?php echo $trade_title ?></i>
					by <?php echo $trade_author ?>
				<?php
				}
				?>
		</div>
		</label>
	</div>
	<?php
}
?>