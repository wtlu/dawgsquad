
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
<!--tabs of Library with links-->
<div class="tabs" id="current">My Books</div>
<?php echo $this->Html->link('My Transactions', "/transactions/my_transactions", array('class' => 'tabs', 'escape' => false)); ?>
<?php echo $this->Html->link('My Loans',"/loans/my_loans", array('class' => 'tabs', 'escape' => false)); ?>
<?php echo $this->Html->link('Add Books', "/books/add_books", array('id' => 'add', 'escape' => false)); ?>
<div id="list">

<?php		//loop to print out books		
		$size = sizeof($book_collection);
		for($i=0; $i < $size; $i++){
	?>
		<div class="book_unit">	
			<img class= "book_img" src="<?=$book_collection[$i]["books"]["image"]?>" alt="<?php echo$book_collection[$i]["books"]["title"]?>"/>
			<ul class="books_list">
				<li>Title: <?php echo $book_collection[$i]["books"]["title"]?></li>
				<li>Author: <?php echo $book_collection[$i]["books"]["author"]?></li>
				<?php 	//if loans not Null Print
					if(!is_null($book_collection[$i]["book_initial_offers"]["duration"])){ ?>
					<li>Loan Duration: <?php echo$book_collection[$i]["book_initial_offers"]["duration"]?> days</li>
				<?php } ?>
				<?php 	//Print trades only if there are trades
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
				<?php 	//if selling print price
					if(!is_null($book_collection[$i]["book_initial_offers"]["price"])){ ?>
						<li>Price: $<?php echo$book_collection[$i]["book_initial_offers"]["price"];?></li>
				<?php } ?>
			</ul>
			<?php echo $this->Html->link('Remove',"/book_initial_offers/remove_confirm/".$book_collection[$i]["book_initial_offers"]["book_id"], array('class' => 'buttons', 'escape' => false)); ?>
			<?php echo $this->Html->link('Change Offer',"/book_initial_offers/edit", array('class' => 'buttons', 'escape' => false)); ?>
		</div>
	<?php
		}

	?>	
</div>

