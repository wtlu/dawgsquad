<?php echo $this->Html->css('library', NULL, array('inline' => FALSE)); ?>
<h1>Please Confirm</h1>
<div id = "remove_unit">
	<img class = "book_img" src = "<?=$offer[0]["books"]["image"]?>" alt="<?=$offer[0]["books"]["title"]?>"/> 
	<p>Are you sure you want to remove <?=$offer[0]["books"]["title"]?> by <?=$offer[0]["books"]["title"]?></p>
</div>
<?php echo $this->Html->link('Yes',"/book_initial_offers/remove/".$offer[0]["book_initial_offers"]["book_id"], array('id' => 'remove', 'escape' => false)); ?>
<?php echo $this->Html->link('Cancel',"/book_initial_offers/my_books/", array('id' => 'cancel', 'escape' => false)); ?>

