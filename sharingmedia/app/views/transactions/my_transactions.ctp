<!--
        created: 5/16/2011

        Author: Ken Inoue



        Changelog:

        5/16/2011 - Ken Inoue- Created page,
		5/18/2011 - Wei-Ting Lu - Added transaction table

-->



<!-- File: /app/models/book_initial_offer.php -->
<?= $this->Html->css('library', NULL, array('inline' => FALSE)); ?>

<h1>My Library</h1>
<!--tabs of Library with links-->
<div id = "menubar">
        <ul id = "menu">
                <li><?= $this->Html->link('My Books', "/book_initial_offers/my_books", array(' escape' => false)); ?></li>
                <li><?= $this->Html->link('My Transactions', "/transactions/my_transactions", array('class' => 'current', 'escape' => false)); ?></li>
                <li><?= $this->Html->link('My Loans',"/loans/my_loans", array('escape' => false)); ?></li>
        </ul>
</div>

<div id="list">
	<?php		//loop to print out transaction		
		$size = sizeof($transaction_collection);
		for($i=0; $i < $size; $i++){
	?>
		<div class="book_unit">	
			<img class= "book_img" src="<?=$transaction_collection[$i]["b"]["image"]?>" alt="<?=$transaction_collection[$i]["b"]["title"]?>"/>
			<ul class="books_list">
				<li>Title: <?= $transaction_collection[$i]["b"]["title"]?></li>
				<li>Author: <?= $transaction_collection[$i]["b"]["author"]?></li>
				<?php 	//if loans not Null Print
					if(!is_null($transaction_collection[$i]["t"]["duration"])){ ?>
						<li>Loan Duration: <?=$transaction_collection[$i]["t"]["duration"]?> days</li>
				<?php } 
					if($transaction_collection[$i]["t"]["trade_id"]== 1){?>
						<li>Trade: Willing to trade</li>
				<?php }	//if selling print price
					if(!is_null($transaction_collection[$i]["t"]["price"])){ ?>
						<li>Price: $<?=$transaction_collection[$i]["t"]["price"];?></li>
				<?php }?>
				<li>Owner: <?= $transaction_collection[$i]["u"]["name"]?></li>
				<li>Client: <?= $transaction_collection[$i]["client_name"]?></li>
				<li>Transaction Status: 
					<?php
						if(($transaction_collection[$i]["t"]["status"]) == 0) { ?>
						Pending
					<?php }
						else if (($transaction_collection[$i]["t"]["status"]) == 1) { ?>
						Complete
					<?php }
						else { //status = 2, canceled ?>
						Canceled
					<?php }?>
				</li>
				<li>Last Updated: 
					<?php
						if (is_null($transaction_collection[$i]["t"]["modified"])) {
							echo $transaction_collection[$i]["t"]["created"];
						} else {
							echo $transaction_collection[$i]["t"]["modified"];
						}
					?>
				</li>
			</ul>
			<?php  
				$loan = $transaction_collection[$i]["t"]["duration"];
				$price = $transaction_collection[$i]["t"]["price"];
				$trade = $transaction_collection[$i]["t"]["trade_id"]; 
				if(is_null($loan)){
					$loan = "NULL";
				}
				if(is_null($price)){
					$price = "NULL";
				}
				$uid=  $this->Session->read('uid');
				$bid= $transaction_collection[$i]["b"]["id"];
				$last= $transaction_collection[$i]["t"]["current_id"];
			?>
			<?php
			if($uid != $last ){
				echo $this->Html->link('View Transaction', "/transactions/transactions/".$bid."/".$transaction_collection[$i]["u"]["facebook_id"]."/".$price."/".$loan."/".$trade, array(' escape' => false));
			}
			
			if($transaction_collection[$i]["t"]["status"] == 1){
				echo $this->Html->link('Delete Transaction', "/transactions/delete_transaction/".$transaction_collection[$i]["t"]["id"]."/".$bid."/".$price."/".$loan."/".$trade."/", array(' escape' => false, 'class' => 'buttons'));
			}
			?>	
		</div>
	<?php
		}

	?>	
	
</div>
     

