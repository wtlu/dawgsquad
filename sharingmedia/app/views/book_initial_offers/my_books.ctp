
<!--

	Created: 5/9/2011

	Author: Ken Inoue

	

	Changelog:

	5/9/2011 - Ken Inoue- Created page,
	5/13/2011 - Ken Inoue- added logic to display only vaild options for trade 

-->



<!-- File: /app/models/book_initial_offer.php -->
<?= $this->Html->css('library', NULL, array('inline' => FALSE)); ?>

<head>
<!--
<script type="text/javascript">
window.fbAsyncInit = function() {
FB.Canvas.setSize();
}
// Do things that will sometimes call sizeChangeCallback()
function sizeChangeCallback() {
FB.Canvas.setSize();
}
</script>
-->
</head>

<body>

<h1>My Library</h1>
<!--tabs of Library with links-->
<div id = "menubar">	
	<ul id = "menu">
		<li class="current">My Books</li>
		<li><?= $this->Html->link('My Transactions', "/transactions/my_transactions", array('escape' => false)); ?></li>
		<li><?= $this->Html->link('My Loans',"/loans/my_loans", array('class' => 'tabs', 'escape' => false)); ?></li>
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

<!--
<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
FB.init({
appId : '218244414868504',
status : true, // check login status
cookie : true, // enable cookies to allow the server to access the session
xfbml : true // parse XFBML
});
</script>
-->
</body>
