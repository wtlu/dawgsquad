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

	</ul>
</div>
<div id="list">

	<?php		//loop to print out books
		$size = sizeof($book_collection_owner);
		for($i=0; $i < $size; $i++){
	?>
		<div class="book_unit">
			<img class= "book_img" src="<?=$book_collection_owner[$i]["books"]["image"]?>" alt="<?=$book_collection_owner[$i]["books"]["title"]?>"/>
			<ul class="books_list">
				<li>Title: <?= $book_collection_owner[$i]["books"]["title"]?></li>
				<li>Author: <?= $book_collection_owner[$i]["books"]["author"]?></li>

				<li>Loaned To: <?= $loan_collection_owner[$i]["loans"]["client_id"]?></li>
				<li>Due Date: <?= $loan_collection_owner[$i]["loans"]["due_date"]?></li>
			</ul>
			<!--
			<?php echo "booksid: " . $book_collection_owner[$i]["books"]["id"];
				echo "duedate: " . $loan_collection_owner[$i]["loans"]["due_date"]; ?>
			-->

			<?php echo $this->Html->link('Complete Loan','/loans/complete_loan/'.$book_collection_owner[$i]["books"]["id"].'/'.$loan_collection_owner[$i]["loans"]["due_date"].'/', array('class' => 'buttons', 'escape' => false)); ?>
		</div>
	<?php
		}

	?>

	<?php		//loop to print out books
		$size = sizeof($book_collection_borrower);
		for($i=0; $i < $size; $i++){
	?>
		<div class="book_unit">
			<img class= "book_img" src="<?=$book_collection_borrower[$i]["books"]["image"]?>" alt="<?=$book_collection_borrower[$i]["books"]["title"]?>"/>
			<ul class="books_list">
				<li>Title: <?= $book_collection_borrower[$i]["books"]["title"]?></li>
				<li>Author: <?= $book_collection_borrower[$i]["books"]["author"]?></li>

				<li>Borrowed From: <?= $loan_collection_borrower[$i]["loans"]["owner_id"]?></li>
				<li>Due Date: <?= $loan_collection_borrower[$i]["loans"]["due_date"]?></li>
			</ul>
		</div>
	<?php
		}

	?>
</div>

</div>
