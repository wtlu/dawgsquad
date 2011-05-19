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
                <li><?= $this->Html->link('My Loans',"/loans/my_loans", array('class' => 'current', 'escape' => false)); ?></li>
                <li id ="add"><?= $this->Html->link('Add Books', "/books/add_books", array('id' => 'add', 'escape' => false)); ?></li>

	</ul>
</div>
<div id="list">
	
	<?php		//loop to print out books		
		$size = sizeof($book_collection);
		for($i=0; $i < $size; $i++){
	?>
		<div class="book_unit">	
			<img class= "book_img" src="<?=$book_collection[$i]["books"]["image"]?>" alt="<?=$book_collection[$i]["books"]["title"]?>"/>
			<ul class="books_list">
				<li>Title: <?= $book_collection[$i]["books"]["title"]?></li>
				<li>Author: <?= $book_collection[$i]["books"]["author"]?></li>
				<?php
					
				
				
				<li>Loaned To: <?= $loan_collection[$i]["loans"]["client_id"]?></li>
				
				<li>Due Date: <?= $loan_collection[$i]["loans"]["due_date"]?></li>
			</ul>
			<?= $this->Html->link('Remove',"/loans/remove_confirm/".$book_collection[$i]["loans"]["book_id"]."/", array('class' => 'buttons', 'escape' => false)); ?>
			<?= $this->Html->link('Complete Loan',"/loans/complete_loan/".$book_collection[$i]["loans"]["book_id"]."/", array('class' => 'buttons', 'escape' => false)); ?>
		</div>
	<?php
		}

	?>	
</div>

</div>
