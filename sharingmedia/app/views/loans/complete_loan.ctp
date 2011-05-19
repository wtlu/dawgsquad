<!--
	Created: 5/8/2011
	Author: James Parsons
	
	Changelog:
	5/8/2011 - James Parsons - Created page, added functionality to print offer details, TODO: write SQL to allow adding new tuple to book_initial_offer on confirm press.
	5/11/2011 - James Parsons - Added ability to recieve book info from calling page, and display the book.
-->
<?php echo $this->Html->css('main', NULL, array('inline' => FALSE)); ?>

<div>

	<h2> Remove Loan? </h2>

	</br>
	
	<fieldset style="border: 3px solid #000000">
	
		<p class="book_display">
			<label >
				<img src=<?php echo $book_collection[0]["books"]["image"] ?> alt="Book image" />
				<strong>Title:</strong>	<?php echo $book_collection[0]["books"]["title"] ?> <br />
				<strong>Author(s):</strong> <?php echo $book_collection[0]["books"]["author"] ?> <br />
				<strong>Loaned To:</strong> <?php echo $client_name ?> <br />
				<strong>Due Date:</strong> <?php echo $due_date ?> <br />
			</label>
		</p>
	</fieldset>

	<?php echo $this->Html->link('Remove Loan',"/loans/remove_loan/".$book_collection[0]["books"]["id"]."/".$this->Session->read["uid"]."/", array('class' => 'buttons', 'escape' => false)); ?>
	
</div>

