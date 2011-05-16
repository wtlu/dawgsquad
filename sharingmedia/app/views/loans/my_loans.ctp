<!--
	created: 5/16/2011

        Author: Ken Inoue



        Changelog:

        5/16/2011 - Ken Inoue- Created page,

-->



<!-- File: /app/models/book_initial_offer.php -->
<?= $this->Html->css('library', NULL, array('inline' => FALSE)); ?>

<h1>My Library</h1>
<!--tabs of Library with links-->
<?= $this->Html->link('My Books',"/book_initial_offers/my_books", array('class' => 'tabs', 'escape' => false)); ?>
<?= $this->Html->link('My Transactions', "/transactions/my_transactions", array('class' => 'tabs', 'escape' => false)); ?>
<div class="tabs" id="current">My Loans</div>
<?= $this->Html->link('Add Books', "/books/add_books", array('id' => 'add', 'escape' => false)); ?>
<div id="list">
	<h2>Comming Soon</h2>
</div>
<?php 
	}
?>
