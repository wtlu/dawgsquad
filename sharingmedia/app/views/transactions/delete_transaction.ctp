<?php echo $this->Html->css('main', NULL, array('inline' => FALSE)); ?>

<div>

	<h2> Remove Loan? </h2>

	<br />
	
	<fieldset style="border: 3px solid #000000">
	
		<p class="book_display">
			<label >
				<img src=<?php echo $image ?> alt="Book image" />
				<strong>Title:</strong>	<?php echo $title ?> <br />
				<strong>Author(s):</strong> <?php echo $author ?> <br />
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
				<strong>Owner:</strong><?php echo $owner ?> <br />
			</label>
		</p>
	</fieldset>

	<?php echo $this->Html->link('Delete Transaction',"/transactions/remove_transaction/".$tid."/", array('class' => 'buttons', 'escape' => false)); ?>
	
</div>