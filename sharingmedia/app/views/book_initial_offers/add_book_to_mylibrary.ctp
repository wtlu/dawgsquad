<!-- File: /app/views/book_initial_offers/add_book_to_mylibrary.ctp -->

<!--
	Created: 5/11/2011
	Author: James Parsons
	
	Changelog:
	5/11/2011 - James Parsons - Created page, as a receipt style confirmation after the book has been added to mylibrary.
-->

<?php echo $this->Html->css('main', NULL, array('inline' => FALSE)); ?>

<div>

	<?php 
		if($add_status){
			echo '<h2> Add Successful!</h2>';
		}else{
			echo '<h2> Add Unsuccessful</h2>';
		}
	?>
	</br>
	
	<fieldset style="border: 3px solid #000000">
		<legend> Your Book </legend>
		<p class="book_display">
			<label >
				<img src=<?php echo $image ?> alt="Book image" />
				<strong>Title:</strong>	<?php echo $title; ?> <br />
				<strong>Author(s):</strong> <?php echo $author ?> <br />
				<strong>ISBN:</strong> <?php echo $ISBN ?> <br />
			</label>
		</p>
	</fieldset>


	<fieldset style="border: 3px solid #000000">
		<legend> Selected Offer Details </legend>
		<p>
		<?php
			if (!empty($offer_type)) {
				
				switch ($offer_type) {
						case 'loan':
							echo '<strong> Loan for ' . $offer_value .' days. </strong>';
							break;
						case 'sell':
							echo '<strong> For Sale at $' . $offer_value .'</strong>';
							break;
						case 'trade':
							echo '<strong> Trade for ' . $offer_value .' </strong>';
							break;
					}
				
			} else {
				echo 'error';
			}
		?>
		</p>
	</fieldset>
	
</div>