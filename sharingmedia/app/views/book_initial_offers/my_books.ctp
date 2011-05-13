
<!--

	Created: 5/9/2011

	Author: Ken Inoue

	

	Changelog:

	5/9/2011 - Ken Inoue- Created page,
	5/13/2011 - Ken Inoue- added logic to display only vaild options for trade 

-->



<!-- File: /app/models/book_initial_offer.php -->
<?php echo $this->Html->css('library', NULL, array('inline' => FALSE)); ?>

<h1>My Library</h1>
<div class="tabs" id="current">My Books</div>
<?php echo $this->Html->link('My Transactions', "/transactions/my_transactions", array('class' => 'tabs', 'escape' => false)); ?>
<?php echo $this->Html->link('My Loans',"/loans/my_loans", array('class' => 'tabs', 'escape' => false)); ?>
<?php echo $this->Html->link('Add Books', "/books/add_books", array('id' => 'add', 'escape' => false)); ?>
<div id="list">
<?php
		$size = sizeof($book_collection);
		for($i=0; $i < $size; $i++){
	?>
		<div class="book_unit">	
			<img class= "book_img" src="<?=$book_collection[$i]["books"]["image"]?>" alt="<?=$book_collection[$i]["books"]["title"]?>"/>
			<ul class="books_list">
				<li>Title: <?=$book_collection[$i]["books"]["title"]?></li>
				<li>Author: <?=$book_collection[$i]["books"]["author"]?></li>
				<?php if(!is_null($book_collection[$i]["book_initial_offers"]["duration"])){ ?>
					<li>Loan Duration: <?=$book_collection[$i]["book_initial_offers"]["duration"]?> days</li>
				<?php } ?>
				<?php 
					$length = sizeof($trade_books[$i]);
					if($length > 0){?>
					<li>Trade for:
						<ul>
							 <?php for($j=0; $j < $length; $j++){ ?>
								<li><?=$trade_books[$i][$j]["books"]["title"]?></li>
						<?php } ?>
						</ul> 
					</li>
				<?php } ?>
				<?php if(!is_null($book_collection[$i]["book_initial_offers"]["price"])){ ?>						<li>Price: $<?=$book_collection[$i]["book_initial_offers"]["price"];?></li>
				<?php } ?>
			</ul>
			<div class="buttons">Remove</div>
			<div class="buttons">Change Offer</div>
		</div>
	<?php
		}

	?>	
</div>

