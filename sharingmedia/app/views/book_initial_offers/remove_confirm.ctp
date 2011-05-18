<?= $this->Html->css('library', NULL, array('inline' => FALSE)); ?>
<h1>Please Confirm</h1>
<div id = "remove_unit">
	<img class = "book_img" src = "<?=$offer[0]["books"]["image"]?>" alt="<?php echo $offer[0]["books"]["title"]?>"/> 
	<p>Are you sure you want to remove <?=$offer[0]["books"]["title"]?> by <?php echo$offer[0]["books"]["author"]?>?</p>
</div>
<?= $this->Html->link('Yes',"/book_initial_offers/remove/".$offer[0]["book_initial_offers"]["book_id"], array('id' => 'remove', 'escape' => false)); ?>
<?= $this->Html->link('Cancel',"/users/coming_soon", array('id' => 'cancel', 'escape' => false)); ?>

