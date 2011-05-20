<?php echo $this->Html->css('main', NULL, array('inline' => FALSE)); ?>

<div>

	<h2> Delete Transaction? </h2>

	<br />
	
	<fieldset style="border: 3px solid #000000">
	
		<p class="book_display">
			<label >
				<img src=<?php echo $book_array[0]["books"]["image"] ?> alt="Book image" />
				<strong>Title:</strong>	<?php echo $book_array[0]["books"]["title"] ?> <br />
				<strong>Author(s):</strong> <?php echo $book_array[0]["books"]["title"] ?> <br />
				<?php 	//if loans not Null Print
					if(!is_null($loan)){ ?>
						<strong>Loan Duration: <?=$loan?> days</strong>
				<?php } 
					if($trade == 1){?>
						<strong>Trade: Willing to trade</strong>
				<?php }	//if selling print price
					if(!is_null($price)){ ?>
						<strong>Price: $<?=$price;?></strong>
				<?php }?>
				<strong>Owner:</strong><?php echo $name ?> <br />
			</label>
		</p>
	</fieldset>

	<?php echo $this->Html->link('Delete Transaction',"/transactions/remove_transaction/".$tid."/", array('class' => 'buttons', 'escape' => false)); ?>
	
</div>