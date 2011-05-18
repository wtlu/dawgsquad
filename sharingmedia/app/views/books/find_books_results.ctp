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

<!--
<script type="text/javascript">
window.fbAsyncInit = function() {
FB.Canvas.setSize();
}
// Do things that will sometimes call sizeChangeCallback()
function sizeChangeCallback() {
FB.Canvas.setSize();
}
</script>
-->
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
			echo $form->create('Transaction', array('action' => 'transactions', 'type'=>'post'));
			# echo $form->create('Users', array('action' => 'coming_soon', 'type'=>'post'));
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
	<hr>
</div>

<!--
<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
FB.init({
appId : '218244414868504',
status : true, // check login status
cookie : true, // enable cookies to allow the server to access the session
xfbml : true // parse XFBML
});
</script>
-->
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
			
			<!-- *****Hidden fields, to transfer data to next page****** -->
			<input name="data[Transaction][title]" value="<?php echo $title ?>" type="hidden">
			<input name="data[Transaction][book_id]" value="<?php echo $result['id'] ?>" type="hidden">
			
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
					
					<!-- *****Hidden fields, to transfer data to next page****** -->
					<input name="data[Transaction][name]" value="<?php echo $name ?>" type="hidden">
					<input name="data[Transaction][user_id]" value="<?php echo $user_result['id'] ?>" type="hidden">
					
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
					if ($allow_trade == 1) {
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