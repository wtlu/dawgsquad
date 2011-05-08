<!-- File: /app/views/posts/add_books.ctp -->	

<?php echo $this->Html->css('main'); ?>

adding bookzz

<div id = "nav_step">
</div>

<div id = "top">
	<h1>Book Info</h1>
	<p>Please fill out one or more of the following fields to find your book.
	For the best results please enter the ISBN number of the book.</p>
</div>

<br>

<div id = "add_form">
	<?php
		echo $this->Form->create(array('action' => 'add_books_results'));
		echo $this->Form->input('title', array('label' => 'Title'));
		echo $this->Form->input('author', array('label' => 'Author'));
		echo $this->Form->input('isbn', array('label' => 'ISBN'));
		echo $this->Form->end('Continue');
	?>
</div>