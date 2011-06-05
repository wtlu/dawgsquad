
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
<p>Books that you currently own. Click Add Books on the left sidebar to add to your collection.</p>
<!--tabs of Library with links-->
<div id = "menubar">
	<ul id = "menu">
		<li class="current"><? echo
			$this->Html->link("My Books",
			"/book_initial_offers/my_books/".$this->Session->read('uid'),
			array('escape' => false)); ?>
		</li>
        <li class="notCurrent"><? echo
			$this->Html->link("Transaction History",
			"/transactions/my_transactions/".$this->Session->read('uid'),
			array('escape' => false)); ?>
		</li>
        <li class="notCurrent"><? echo
			$this->Html->link("My Loans",
			"/loans/my_loans/".$this->Session->read('uid'),
			array('escape' => false)); ?>
		</li>
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
				<?php }
					if($book_collection[$i]["book_initial_offers"]["trade_id"] >= 0){?>
						<li>Trade: Willing to trade</li>
				<?php }	//if selling print price
					if(!is_null($book_collection[$i]["book_initial_offers"]["price"])){ ?>
						<li>Price: $<?=$book_collection[$i]["book_initial_offers"]["price"];?></li>
				<?php }?>
			</ul>
			<?= $this->Html->link('Remove',"/book_initial_offers/remove_confirm/".$this->Session->read('uid')."/".$book_collection[$i]["book_initial_offers"]["book_id"]."/", array('class' => 'buttons', 'escape' => false)); ?>
			<?= $this->Html->link('Change Offer',"/book_initial_offers/edit/".$this->Session->read('uid')."/".$book_collection[$i]["book_initial_offers"]["book_id"]."/", array('class' => 'buttons', 'escape' => false)); ?>
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
