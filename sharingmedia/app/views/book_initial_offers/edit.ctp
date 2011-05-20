<?php echo $this->Html->css('initial_offers', NULL, array('inline' => FALSE)); ?>
<div class="top_progress_arrows">
        <?php echo $this->Html->image('arrow_choose_offer_details.png', array('alt' => 'book info')) ?>
</div>

<fieldset>
<p class="book_results_display">
                <?php
                        $title = $book_chosen[1];
                        $author = $book_chosen[2];
                        $ISBN = $book_chosen[3];
                        $image = $book_chosen[4];       
                ?>
        <img src=<?php echo $image ?> alt="Book image" />
        <strong>Title:</strong> <?php echo $title; ?> <br />
        <strong>Author(s):</strong> <?php echo $author ?> <br />
        <strong>ISBN:</strong> <?php echo $ISBN ?> <br />
	<strong></strong>
</p>
</fieldset>

<fieldset >

<legend style="color:black;">Initial Offer Details</legend>

<div id="outer_area">

        <p>
        Please select the new intitial offer that will be listed in your library, for other users to consider when they want your book. You can specify a loan duration in days, a price in dollars, or if you are willing to consider other books in trade. Please enter
        </p>

        
        <?php echo $form->create('BookInitialOffer', array('action' => 'add_books_confirm', 'type'=>'post')); ?>
              
        
                
        <div class="options">  
    		<input name="data[BookInitialOffer][offer_loan]" id="choose_loan" value="loan" type="checkbox">
                <label for="choose_loan">Loan For</label>
                <?php
                    echo $this->Form->input('loan_duration', array('label' => '', 'class'=>'field', 'maxlength' => '6'));
                ?>
        </div>

        <div class="options">
        	<input name="data[BookInitialOffer][offer_sell]" id="choose_sell" value="sell" type="checkbox">
       		<label for="choose_sell">Sell For</label>
 		<?php
                	echo $this->Form->input('sell_price', array('label' => '', 'class'=>'field', 'maxlength' => '6'));
                ?>
       	 </div>
         <div class="options">
                <input name="data[BookInitialOffer][offer_trade]" id="choose_trade" value="trade" type="checkbox">
                <label id="special" for="choose_trade">Willing to consider trades?</label>
                </div>
                <?php
                        echo $this->Form->end('Add To MyLibrary');
                ?>
	</div>
</fieldset>



