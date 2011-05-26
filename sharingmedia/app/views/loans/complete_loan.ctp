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
				
				
				<strong>Loaned To:</strong> <?php echo $name ?> <br />
				
				<strong>Due Date:</strong> <?php echo $due_date ?> <br />
			</label>
		</p>
	</fieldset>

	<?php echo $form->create('Loan', array('action' => "remove_loan/".$book_info[0]["books"]["id"]."/".$this->Session->read('uid')."/", 'class' => 'buttons', 'escape' => false)); 
	
	echo $this->Form->end('Complete Loan');?>
	
</div>

