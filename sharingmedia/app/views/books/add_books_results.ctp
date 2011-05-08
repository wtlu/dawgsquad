<!-- File: /app/views/posts/add_books_results.ctp -->

<?php echo $this->Html->css('main'); ?>

book resultzzz

<?php
	if (!empty($book_results)) {
		foreach ($book_results as $k){
			foreach ($k as $i) {
				foreach ($i as $j) {
					echo $j;
				}
			}
		}
	} else {
		echo "no results - title:";
		echo $search_title;
		#
	}
?>