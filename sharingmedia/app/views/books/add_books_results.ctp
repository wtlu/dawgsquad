<!-- File: /app/views/posts/add_books_results.ctp -->

<?php echo $this->Html->css('main'); ?>

<h2>Is this yours? </h2>

<?php
	if (!empty($book_results)) {
		foreach ($book_results as $book){ 
			$result = $book['books'];
			?>
			<div class="search_result">
				<p class="book_result">
					<?php 
						$title = $result['title'];
						$author = $result['author'];
						$isbn = $result['ISBN'];
						$image = $result['image'];
						
						echo $this->Html->image($image, array('alt' => 'Book image'));
					?>

					<strong>Title:</strong>	<?= $title ?> <br />
					<strong>Author(s):</strong> <?= $author ?> <br />
					<strong>ISBN:</strong> <?= $isbn ?> <br />
				</p>
				<hr>
			</div>
		<?php
		}
	} else {
		foreach ($google_results as $result){
			?>
			<div class="search_result">
				<p class="book_result">
					<?php
						$title = $result['Title'][1];
						$author = '';
						if (array_key_exists('creator', $result)) {
							$author = $result['creator'];
						} else {
							foreach ($result['Creator'] as $an_author) {
								$author = $author . ', '. $an_author;
							}
						}
						$isbn = $result['Identifier'][1];
						$image = $result['Link'][0]['href'];

						echo $this->Html->image($image, array('alt' => 'Book image'));
					?>

					<strong>Title:</strong>	<?= $title ?> <br />
					<strong>Author(s):</strong> <?= $author ?> <br />
					<strong>ISBN:</strong> <?= $isbn ?> <br />
				</p>
				<hr>
			</div>
		<?php
		}
	}
?>