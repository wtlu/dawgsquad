<!-- File: /app/views/posts/add_books_results.ctp -->

<?php echo $this->Html->css('main'); ?>

<h2>Is this yours? </h2>

<?php
	if (!empty($book_results)) {
		foreach ($book_results as $book){ 
			$result = $book['books'];
			display_results($result);
		}
	} else {
		foreach ($google_books_results as $result){
			display_results($result);
		}
	}
?>

<?php
#functions

function display_results($result) {
	?>
	<div class="search_result">
		<p class="book_result">
			<?php
				$title = $result['title'];
				$author = $result['author'];
				$ISBN = $result['ISBN'];
				$image = $result['image'];
			?>
			<img src=<?= $image ?> alt="Book image" />
			<strong>Title:</strong>	<?= $title ?> <br />
			<strong>Author(s):</strong> <?= $author ?> <br />
			<strong>ISBN:</strong> <?= $ISBN ?> <br />
		</p>
		<hr>
	</div>
	<?php
}
?>