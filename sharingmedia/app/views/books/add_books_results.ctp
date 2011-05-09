<!-- File: /app/views/posts/add_books_results.ctp -->

<?php echo $this->Html->css('main'); ?>

book resultzzz

<?php
	if (!empty($book_results)) {
		foreach ($book_results as $result){ 
			?>
			<div class="search_result">
				<p class="image">
					<?php 
						$title = $result[0];
						$author = $result[1];
						$isbn = $result[2];
						$image = $result[3];
						echo $isbn;
					?>
				</p>
			</div>
		<?php
		}
	} else {
		echo $google_results;
	}
?>