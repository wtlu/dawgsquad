<!-- File: /app/views/books/find_books_results.ctp -->

<!--
	Created: 5/10/2011
	Author: John Wang
	
	Changelog:
	5/10/2011 - John Wang - Created page. Copied relevant code from add books results
	
	<?php echo $this->Html->css('main'); ?>
-->
<?php echo $this->Html->css('main', NULL, array('inline' => FALSE)); ?>

<h2>Results:</h2>

<?php
	echo $form->create('BookInitialOffer', array('action' => 'initial_offer_details', 'type'=>'post'));

	if (!empty($book_results)) {
		foreach ($book_results as $book){ 
			$result = $book['books'];
			display_results($result);
		}
	} else {
		?>
		<p> No results. Please try your search again. </p>
		<?php
	}
	
	echo $this->Form->end('Continue');
?>

<?php
#functions

function display_results($result) {
	$chosen = '';
	foreach ($result as $element) {
		$chosen = $chosen . '^' . $element;
	}
	
	?>
	<!-- THIS DOES NOT WORK. CANNOT SET value = an array -->
	<p class="book_display">
		<input class="radio_button" name="data[Book][book_type]" id="choose_book" value="<?php echo $chosen ?>" type="radio" style="width:30px; float:left;">
		<label for="choose_book">
			<?php
				$title = $result['title'];
				$author = $result['author'];
				$ISBN = $result['ISBN'];
				$image = $result['image'];
				$summary = $result['summary'];
			?>
		<img src=<?php echo $image ?> alt="Book image" />
		<strong>Title:</strong>	<?php echo $title ?> <br />
		<strong>Author(s):</strong> <?php echo $author ?> <br />
		<strong>Summary:</strong> <?php echo $summary ?> <br />
		<strong>ISBN:</strong> <?php echo $ISBN ?> <br />
		</label>
	</p>
	<?php
}
?>