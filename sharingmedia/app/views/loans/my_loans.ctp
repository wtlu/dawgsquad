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
<div id = "menubar">
        <ul id = "menu">
        	<li><?= $this->Html->link('My Books', "/book_initial_offers/my_books", array(' escape' => false)); ?></li>
                <li><?= $this->Html->link('My Transactions', "/transactions/my_transactions", array('escape' => false)); ?></li>
                <li><?= $this->Html->link('My Loans',"/sharingmedia/loans/my_loans", array('class' => 'current', 'escape' => false)); ?></li>
                <li id ="add"><?= $this->Html->link('Add Books', "/sharingmedia/books/add_books", array('id' => 'add', 'escape' => false)); ?></li>

	</ul>
</div>
<div id="list">
	<h2>Comming Soon</h2>
</div>
