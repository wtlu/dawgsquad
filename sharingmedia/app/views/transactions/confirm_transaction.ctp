<?php echo $this->Html->css('transaction', NULL, array('inline' => FALSE)); ?>

<div>

	<h2> Confirm Transaction </h2>

	</br>

	<p>You're almost done! Review the transaction details below, then click Complete Transaction to accept this
	transaction.</p>

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

<?php echo $form->create('Transaction', array('action' => 'accept_transaction'."/".$data['Transaction']['book_id']."/".
																					$data['Transaction']['owner_id']."/".
																					$data['Transaction']['price']."/".
																					$data['Transaction']['duration']."/".
																					$data['Transaction']['allow_trade']."/", 'type'=>'post')); ?>

<?php
	echo $this->Form->end('Complete Transaction!');
?>