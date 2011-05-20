<?php echo $this->Html->css('main', NULL, array('inline' => FALSE)); ?>

<div>

	<h2> Remove Loan? </h2>

	<br />
	
	<fieldset style="border: 3px solid #000000">
	
		<p class="book_display">
			<label >
				<img src=<?php echo $book_info[0]["books"]["image"] ?> alt="Book image" />
				<strong>Title:</strong>	<?php echo $book_info[0]["books"]["title"] ?> <br />
				<strong>Author(s):</strong> <?php echo $book_info[0]["books"]["author"] ?> <br />
				
				<?php if($identify == 0){ ?>
				
						<strong>Loaned To:</strong> <?php echo $name ?> <br />
						
				<?php } else { ?>
				
						<strong>Borrowed From:</strong> <?php echo $name ?> <br />
						
				<?php } ?>
				
				<strong>Due Date:</strong> <?php echo $due_date ?> <br />
			</label>
		</p>
	</fieldset>

	<?php echo $this->Html->link('Remove Loan',"/loans/remove_loan/".$book_info[0]["books"]["id"]."/".$this->Session->read('uid')."/".$identify."/".$o_id."/", array('class' => 'buttons', 'escape' => false)); ?>
	
</div>

