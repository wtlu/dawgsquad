<!-- File: /app/views/books/find_books_results.ctp

	Created: 5/10/2011
	Author: John Wang

	Changelog:
	5/10/2011 - John Wang - Created page. Copied relevant code from add books results
	5/11/2011 - John Wang - Changed results formatting some more
	5/13/2011 - John Wang - Added a back button
	5/14/2011 - John Wang - Added comments

-->
<head>
<?php echo $this->Html->css('main', NULL, array('inline' => FALSE)); ?>
<?php echo $this->Html->css('book_results', NULL, array('inline' => FALSE)); ?>

</head>

<body>

<h2>Results:</h2>

<div class = "results_display">
	<FORM METHOD="LINK" ACTION="find_books">
	<INPUT class = "special_button" TYPE="submit" VALUE="New Search">
	</FORM>
<?php
	if (!empty($book_results)) {
		foreach ($book_results as $book){
			$temp = $this->Session->read('friends');
			$owner_id = $book['users']['facebook_id'];
			if($temp["$owner_id"]){
			$result = $book['books'];
			$user_result = $book['users'];
			echo $form->create('Transaction', array('action' => 'transactions'."/". $result['id'] ."/".$user_result['facebook_id']."/"."NULL/NULL/0/".$this->Session->read('uid'), 'type'=>'post'));

			// search queries, for back button
			echo $this->Form->input('title', array('type' => 'hidden', 'value' => $book_title));
			echo $this->Form->input('author', array('type' => 'hidden', 'value' => $book_author));
			echo $this->Form->input('isbn', array('type' => 'hidden', 'value' => $book_isbn));

			$b_i_o_result = $book['b_i_o'];
			$trade_book = array();
			if (array_key_exists('trade_book', $book)) {
				$trade_book = $book['trade_book'];
			}
			display_results($result, $user_result, $b_i_o_result, $trade_book);
			echo $this->Form->end('Start a Transaction');
			}
		}
	} else {
		?>
		<p> No results. Please try your search again. </p>
		<?php
	}
	?>
	<hr>
</div>

</body>

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

			<!-- *****Hidden fields, to transfer data to next page******
			<input name="data[Transaction][book_id]" value="<?php echo $result['id'] ?>" type="hidden">-->

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

					<!-- *****Hidden fields, to transfer data to next page******
					<input name="data[Transaction][user_id]" value="<?php echo $user_result['facebook_id'] ?>" type="hidden">-->

				<h3> Offer Details </h3>
					<?php
						$price = $b_i_o_result['price'];
						$duration = $b_i_o_result['duration'];
						$allow_trade = $b_i_o_result['trade_id'];
						/*
						if (!empty($trade_book)) {
							$trade_title = $trade_book['title'];
							$trade_author = $trade_book['author'];
						}
						*/
					if (!empty($price)) {
					?>
						<strong>Price: $</strong><?= $price ?> <br />

						<!-- *****Hidden fields, to transfer data to next page****** -->
						<input name="data[Transaction][price]" value="<?php echo $price ?>" type="hidden">

					<?php
					}
					if (!empty($duration)) {
					?>
						<strong>Loan Duration:</strong> <?= $duration ?> days<br />

						<!-- *****Hidden fields, to transfer data to next page****** -->
						<input name="data[Transaction][duration]" value="<?php echo $duration ?>" type="hidden">

					<?php
					}
					if ($allow_trade == 0) {
					?>
						<strong>Willing to consider a trade.</strong>
						<!-- *****Hidden fields, to transfer data to next page****** -->
						<input name="data[Transaction][allow_trade]" value="<?php echo $allow_trade ?>" type="hidden">
					<?php
					}
					?>
			</div>
		</label>
	</div>
	<?php
}
?>