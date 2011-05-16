
<!--

	Created: 5/9/2011

	Author: Ken Inoue

	

	Changelog:

	5/9/2011 - Ken Inoue- Created page,
	5/13/2011 - Ken Inoue- added logic to display only vaild options for trade 

-->



<!-- File: /app/models/book_initial_offer.php -->
<?= $this->Html->css('library', NULL, array('inline' => FALSE)); ?>

<h1>My Library</h1>
<!--tabs of Library with links-->
<div class="tabs" id="current">My Books</div>
<?= $this->Html->link('My Transactions', "/transactions/my_transactions", array('class' => 'tabs', 'escape' => false)); ?>
<?= $this->Html->link('My Loans',"/loans/my_loans", array('class' => 'tabs', 'escape' => false)); ?>
<?= $this->Html->link('Add Books', "/books/add_books", array('id' => 'add', 'escape' => false)); ?>
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
				<?php 	//if loans not Null Print
					if(!is_null($book_collection[$i]["book_initial_offers"]["duration"])){ ?>
						<li>Loan Duration: <?=$book_collection[$i]["book_initial_offers"]["duration"]?> days</li>
				<?php } else {?>
						<li>Loan Duration: Will not lend</li>
				<?php }
					if($book_collection[$i]["book_initial_offers"]["trade_id"]== 1){?>
					<li>Trade: Willing to trade</li>
				<?php }else { ?>
					<li>Trade: Not willing to trade</li>
				<?php }	//if selling print price
					if(!is_null($book_collection[$i]["book_initial_offers"]["price"])){ ?>
						<li>Price: $<?=$book_collection[$i]["book_initial_offers"]["price"];?></li>
				<?php } else{?>
						<li>Price: Not for sale</li>
				<?php }?>
			</ul>
			<?= $this->Html->link('Remove',"/book_initial_offers/remove_confirm/".$book_collection[$i]["book_initial_offers"]["book_id"]."/", array('class' => 'buttons', 'escape' => false)); ?>
			<?= $this->Html->link('Change Offer',"/book_initial_offers/edit", array('class' => 'buttons', 'escape' => false)); ?>
		</div>
	<?php
		}

	?>	
</div>

