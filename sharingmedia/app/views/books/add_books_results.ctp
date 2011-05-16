<!-- File: /app/views/books/add_books_results.ctp 

	Created: 5/8/2011
	Author: John Wang
	
	Changelog:
	5/8/2011 - John Wang - Created page, added functionality to receive data pulled from our db and Google
	5/9/2011 - John Wang - Changed results into radios. Now goes to the next step, but no data posted yet
	5/10/2011 - John Wang - Added ability to post results to next step
	5/11/2011 - John Wang - Fixed some of the formatting of the page
	5/13/2011 - John Wang - Added back button.
	5/14/2011 - John Wang - Added comments
	
	# This is the view for the add books results page
-->
<?php echo $this->Html->css('main', NULL, array('inline' => FALSE)); ?>
<?php echo $this->Html->css('book_results', NULL, array('inline' => FALSE)); ?>

<div class="top_progress_arrows">
	<?php echo $this->Html->image('arrow_choose_book.png', array('alt' => 'book info')) ?>
</div>

<h2>Choose the book that matches yours:</h2>
<div class = "results_display">
	<FORM METHOD="LINK" ACTION="add_books">
	<INPUT class = "special_button" TYPE="submit" VALUE="New Search">
	</FORM>
<?php
	if ($index > 10) {
		echo $this->Form->create(array('action' => 'add_books_results'));
		echo $this->Form->input('title', array('type' => 'hidden', 'value' => $book_title));
		echo $this->Form->input('author', array('type' => 'hidden', 'value' => $book_author));
		echo $this->Form->input('isbn', array('type' => 'hidden', 'value' => $book_isbn));
		echo $this->Form->input('index', array('type' => 'hidden', 'value' => $index - 10));
		echo $this->Form->end('Previous results');
	}
	
	/* if (!empty($book_results)) {
		echo $form->create('BookInitialOffer', array('action' => 'initial_offer_details', 'type'=>'post'));
		foreach ($book_results as $book){ 
			$result = $book['books'];
			display_results($result);
		}
		echo $this->Form->end('Continue');
	} else */
	if (!empty($google_books_results)) {
		#echo $form->create('BookInitialOffer', array('action' => 'initial_offer_details', 'type'=>'post'));
		foreach ($google_books_results as $result){
			echo $form->create('BookInitialOffer', array('action' => 'initial_offer_details', 'type'=>'post'));
			display_results($result);
			echo $this->Form->end('Add This Book');
		}
		#echo $this->Form->end('Continue');
	} else {
		?>
		<p> No results. Please try your search again. </p>
		<?php
	}
	?>
	<hr>
	<?php
	if (count($google_books_results) > 10) {
		echo $this->Form->create(array('action' => 'add_books_results'));
		echo $this->Form->input('title', array('type' => 'hidden', 'value' => $book_title));
		echo $this->Form->input('author', array('type' => 'hidden', 'value' => $book_author));
		echo $this->Form->input('isbn', array('type' => 'hidden', 'value' => $book_isbn));
		echo $this->Form->input('index', array('type' => 'hidden', 'value' => $index + 10));
		echo $this->Form->end('More results');
	}
	?>
	
	<FORM METHOD="LINK" ACTION="add_books">
	<INPUT class = "special_button" TYPE="submit" VALUE="New Search">
	</FORM>
	<?php
?>
</div>

<?php
# helper function to display book results
function display_results($result) {
	$chosen = '';
	# build the string of book data and pass on to initial_offer_details function in book initial offers controller
	foreach ($result as $element) {
		$chosen = $chosen . '^' . $element;
	}
	?>
	<div class="book_results_display">
		
		<input name="data[Book][book_type]" id="choose_book" value="<?= $chosen ?>" type="hidden">
		
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
		</div>
		</label>
	</div>
	<?php
}
?>