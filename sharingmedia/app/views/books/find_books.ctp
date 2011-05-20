<!-- File: /app/views/find_books.ctp -->

<!--
	Created: 5/10/2011
	Author: John Wang

	Changelog:
	5/10/2011 - John Wang - Created page, added form

-->
<?php echo $this->Html->css('main', NULL, array('inline' => FALSE)); ?>

<div class = "book_search_form">

	<div id = "top">
		<h1>Find Books</h1>
		<p>Please fill out one or more of the following fields. For the best results
		please also enter the ISBN number of the book.</p>
	</div>

	<br>

	<div>
		<?php
			echo $this->Form->create(array('action' => 'find_books_results'));
			echo $this->Form->input('title', array('label' => 'Title'));
			echo $this->Form->input('author', array('label' => 'Author(s)'));
			echo $this->Form->input('isbn', array('label' => 'ISBN'));
			echo $this->Form->end('Continue');
		?>
	</div>

</div>