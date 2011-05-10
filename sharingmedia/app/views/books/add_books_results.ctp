<!-- File: /app/views/books/add_books_results.ctp -->

<!--
	Created: 5/8/2011
	Author: John Wang
	
	Changelog:
	5/8/2011 - John Wang - Created page, added functionality to receive data pulled from our db and Google
	5/9/2011 - John Wang - Changed results into radios. Now goes to the next step, but no data posted yet
-->

<?php echo $this->Html->css('main'); ?>

<h2>Choose the book that matches yours:</h2>

<?php
	echo $form->create('BookInitialOffer', array('action' => 'initial_offer_details', 'type'=>'post'));

	if (!empty($book_results)) {
		foreach ($book_results as $book){ 
			$result = $book['books'];
			display_results($result);
		}
	} else if (!empty($google_books_results)) {
		foreach ($google_books_results as $result){
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
	?>
	<!-- THIS DOES NOT WORK. CANNOT SET value = an array -->
	<p class="book_display">
		<input name="data['Book']['book_type']" id="choose_book" value=<?= $result ?> type="radio" style="width:50px; float:left;">
		<label for="choose_book">
			<?php
				$title = $result['title'];
				$author = $result['author'];
				$ISBN = $result['ISBN'];
				$image = $result['image'];
			?>
		<img src=<?= $image ?> alt="Book image" />
		<strong>Title:</strong>	<?= $title ?> <br />
		<strong>Author(s):</strong> <?= $author ?> <br />
		<?= $ISBN ?> <br />
		</label>
	</p>
	<?php
}
?>