<?php echo $this->Html->css('transaction', NULL, array('inline' => FALSE)); ?>

<div>

	<h2> Transaction Accepted! </h2>

	<br />

	<p>Congratulations, you have a completed a transaction! Please use Facebook's private messaging system to
	make an exchange. Final transaction details are as follows:</p>

	<br />

	<fieldset>
		<legend> Book Offer </legend>
		<p class="book_display">
			<label >
				<img src=<?= $data['Transaction']['book_image'] ?> alt="Book image" />
				<strong>Title:</strong>	<?= $data['Transaction']['book_title'] ?> <br />
				<strong>Author(s):</strong> <?= $data['Transaction']['book_author'] ?> <br />
				<strong>ISBN:</strong> <?= $data['Transaction']['book_isbn'] ?> <br />
			</label>
		</p>
	</fieldset>

	<fieldset>
		<legend> Owner Information </legend>
		<p>
			<label >
				<strong>Name:</strong>	<?= $data['Transaction']['owner_name'] ?> <br />
			</label>
		</p>
	</fieldset>


	<fieldset>
		<legend> Selected Offer Details </legend>
		<p>
		<?php

			if(!empty($data['Transaction']['duration'])){
				echo '<strong> Loan for ' . $data['Transaction']['duration'] .' days. </strong></br>';
			}

			if(!empty($data['Transaction']['price'])){
				echo '<strong> For Sale at $' . $data['Transaction']['price'] .'</strong></br>';
			}

			if(!empty($data['Transaction']['allow_trade'])){
				echo '<strong> Some trade book here. </strong></br>';
			}

		?>
		</p>
	</fieldset>

</div>