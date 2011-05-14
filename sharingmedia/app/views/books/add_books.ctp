<!--
File: /app/views/add_books.ctp
 
	Created: 5/8/2011
	Author: John Wang
	
	Changelog:
	5/8/2011 - John Wang - Created page, added form
	
	# This is the view for the add books form.
-->
<?php echo $this->Html->css('main', NULL, array('inline' => FALSE)); ?>

<div class = "book_search_form">

	<div id = "top">
		<h1>Book Information</h1>
		<p>Please fill out one or more of the following fields to find the book that matches the one you
		want to add. For the best results please also enter the ISBN number of the book.</p>
	</div>

	<br>

	<div>
		<?php
			echo $this->Form->create(array('action' => 'add_books_results'));
			echo $this->Form->input('title', array('label' => 'Title'));
			echo $this->Form->input('author', array('label' => 'Author(s)'));
			echo $this->Form->input('isbn', array('label' => 'ISBN'));
			echo $this->Form->end('Continue');
		?>
	</div>

</div>