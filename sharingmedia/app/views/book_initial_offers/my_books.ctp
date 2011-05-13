
<!--

	Created: 5/9/2011

	Author: Ken Inoue

	

	Changelog:

	5/8/2011 - Ken Inoue- Created page, 

-->



<!-- File: /app/models/book_initial_offer.php -->
<?php echo $this->Html->css('main'); ?>
<?php echo $this->Html->css('main', NULL, array('inline' => FALSE)); ?>

<h2>My Library</h1>
<div class="tabs">My Books</div>
<div class="tabs">My Transactions</div>
<div class="tabs">My Loans</div>
<div id="add">+ Add Book</div>
<div id="list">
<?php
		$size = sizeof($book_collection);
		for($i=0; $i < $size; $i++){
	?>
			
		<img class= "book_display" src="<?=$book_collection[$i]["books"]["image"]?>" alt="<?=$book_collection[$i]["books"]["title"]?>"/>
		<ul>
			<li>Title: <?=$book_collection[$i]["books"]["title"]?></li>
			<li>Author: <?=$book_collection[$i]["books"]["author"]?></li>
			<li>Loan Duration: <?=$book_collection[$i]["book_initial_offers"]["duration"]?> days</li>
			<li>Trade for:
				<ul>
				<?php $length = sizeof($trade_books[$i]);
					 for($j=0; $j < $length; $j++){ ?>
						<li><?=$trade_books[$i][$j]["books"]["title"]?></li>
					<?php } ?>
				</ul> 
			</li>
			<li>Price: $<?=$book_collection[$i]["book_initial_offers"]["price"];?></li>
		</ul>
		<div class="buttons">Remove</div>
		<div class="buttons">Change Offer</div>
	<?php
		}

	?>	
</div>

