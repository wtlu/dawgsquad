



<?php echo $this->Html->css('main', NULL, array('inline' => FALSE)); ?>


<h2> Book that was accepted for trade no longer exists in the client's Library </h2>
<p>The book that was offered as a trade has been removed from the client's library in the intermediate 
time since the offer was made. Therfore, a different option must be selected for this transaction.</p>

<?php
echo $form->create('Transaction', array('escape'=> false, 'action' => 'transactions'."/".
																					$data['Transaction']['book_id']."/".
																					$data['Transaction']['owner_id']."/".
																					$data['Transaction']['price']."/".
																					$data['Transaction']['duration']."/".
																					$data['Transaction']['trade_id']."/".
																					$data['Transaction']['client_id']."/", 'type'=>'post'));

echo $this->Form->end('Return to Transaction Details');
	
?>