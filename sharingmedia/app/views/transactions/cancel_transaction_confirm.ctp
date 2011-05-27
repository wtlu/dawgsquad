<?php echo $this->Html->css('main', NULL, array('inline' => FALSE));

$book_array = $data['Transaction']['book_array'];
$tid = $data['Transaction']['t_array'][0]['t']['id'];
$loan = $data['Transaction']['t_array'][0]['t']['duration'];
$price = $data['Transaction']['t_array'][0]['t']['price'];
$trade = $data['Transaction']['t_array'][0]['t']['trade_id'];

?>

<div>

	<h2> Cancel Transaction? </h2>

	<br />

	<fieldset style="border: 3px solid #000000">

		<p class="book_display">
			<label >
				<img src=<?php echo $book_array[0]["books"]["image"] ?> alt="Book image" />
				<strong>Title:</strong>	<?php echo $book_array[0]["books"]["title"] ?> <br />
				<strong>Author(s):</strong> <?php echo $book_array[0]["books"]["author"] ?> <br />
				<?php 	//if loans not Null Print
					if(!is_null($loan) && $loan != "NULL"){ ?>
						<strong>Loan Duration: <?=$loan?> days</strong> <br />
				<?php }
					if($trade == 1){?>
						<strong>Trade: Willing to trade</strong> <br />
				<?php }	//if selling print price
					if(!is_null($price) && $price != "NULL"){ ?>
						<strong>Price: $<?=$price;?></strong> <br />
				<?php }?>
				<strong>Owner: </strong><?php echo $data['Transaction']['owner_name'] ?> <br />
			</label>
		</p>
	</fieldset>
	<?php echo $this->Html->link('Go Back',"/transactions/my_transactions/".$this->Session->read('uid'), array('class' => 'buttons', 'escape' => false)); ?>
	<?php echo $this->Html->link('Cancel Transaction',"/transactions/cancel_transaction/".$tid."/", array('class' => 'buttons', 'escape' => false)); ?>

</div>
