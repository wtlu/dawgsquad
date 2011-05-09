<!-- File: /app/views/posts/add_books_results.ctp -->

<?php echo $this->Html->css('main'); ?>

book resultzzz

<?php
	foreach ($book_results as $k){
		foreach ($k as $i) {
			foreach ($i as $j) {
				echo $j;
			}
		}
	}
?>