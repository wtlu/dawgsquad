<!-- File: /app/views/books/find_books_results.ctp

	Created: 5/10/2011
	Author: John Wang
	
	Changelog:
	5/10/2011 - John Wang - Created page. Copied relevant code from add books results
	5/11/2011 - John Wang - Changed results formatting some more
	5/13/2011 - John Wang - Added a back button
	5/14/2011 - John Wang - Added comments
	
-->
<?php echo $this->Html->css('main', NULL, array('inline' => FALSE)); ?>
<?php echo $this->Html->css('book_results', NULL, array('inline' => FALSE)); ?>

<h2>Results:</h2>

<div class = "results_display">
	<FORM METHOD="LINK" ACTION="find_books">
	<INPUT TYPE="submit" VALUE="Go Back">
	</FORM>
<?php
	if (!empty($book_results)) {
		foreach ($book_results as $book){
			echo $form->create('Users', array('action' => 'comming_soon', 'type'=>'post'));
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
	?>
	<FORM METHOD="LINK" ACTION="find_books">
	<INPUT TYPE="submit" VALUE="Go Back">
	</FORM>
</div>

<?php

# helper function to display find book results using the results array passed from books controller
function display_results($result, $user_result, $b_i_o_result, $trade_book) {
	?>
	<div class="book_results_display">
		<label for="choose_book">
			<?php
				$title = $result['title'];
				$author = $result['author'];
				$ISBN = $result['ISBN'];
				$image = $result['image'];
				$summary = $result['summary'];
			?>
			<img src=<?= $image ?> alt="Book image" />
			<div class = "book_results_text">
					<strong>Title:</strong>	<?= $title ?> <br />
					<strong>Author(s):</strong> <?= $author ?> <br />
					<strong>Summary:</strong> <?= $summary ?> <br />
					<strong>ISBN:</strong> <?= $ISBN ?> <br />
				<h3> Owner </h3>
					<?php
						$name = $user_result['name'];
					?>
					<strong>Name:</strong>	<?= $name ?> <br />
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
					<strong>Price: $</strong><?= $price ?> <br />
					<?php
					}
					if (!empty($duration)) {
					?>
					<strong>Loan Duration:</strong> <?= $duration ?> days<br />
					<?php
					}
					if (!empty($trade_book)) {
					?>
					<strong>Willing to trade for:</strong> <i><?= $trade_title ?></i>
						by <?= $trade_author ?>
					<?php
					}
					?>
			</div>
		</label>
	</div>
	<?php
}
?>