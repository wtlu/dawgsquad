<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php echo $this->Facebook->html() ?>
<head>
	<title><?php echo $title_for_layout?></title>
	<?php echo $scripts_for_layout ?>
	<?php echo $this->Html->css('layout'); ?>
</head>
<body>
	
	<div id="top_section">

		<div id="top_bar_logo">
  			<?php echo $this->Html->image('logo.png', array('alt' => 'SharingBooksLogo')) ?>
		</div>
	
		<div id="top_bar_options">
  			<p><?php echo $this->Html->link('Account', 'http://localhost/sharingmedia/index.php/users/comming_soon', array('class' => 'tab')); ?> | <?php echo $this->Html->link('FAQ', 'http://localhost/sharingmedia/index.php/users/comming_soon', array('class' => 'tab')); ?> | <?php echo $this->Html->link('Help', 'http://localhost/sharingmedia/index.php/users/comming_soon', array('class' => 'tab')); ?> | 
  			<?php 
  			if($facebook_user){ 
				echo $this->Facebook->logout(array('redirect' => array('controller' => 'users','action' => 'logout')));
  			} ?>
  			</p>
		</div>
	</div>
	
	<div id="side_bar">
		<div id="tabs">
			<?php echo $this->Html->link('Home', 'http://localhost/sharingmedia/index.php', array('class' => 'tab')); ?> 
			<?php echo $this->Html->link('Add Books', 'http://localhost/sharingmedia/index.php/books/add_books', array('class' => 'tab')); ?>
			<?php echo $this->Html->link('Find Books', 'http://localhost/sharingmedia/index.php/books/find_books', array('class' => 'tab')); ?>
			<?php echo $this->Html->link('My Library', 'http://localhost/sharingmedia/index.php/book_initial_offers/my_books', array('class' => 'tab')); ?>
		</div>
	</div>
<?php echo $content_for_layout ?>
<?php echo $this->Facebook->init(); ?>
</body>
</html>