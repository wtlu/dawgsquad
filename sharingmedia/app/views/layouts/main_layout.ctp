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
  			<p><?php echo $this->Html->link('Account', "/users/comming_soon", array('class' => 'tab', 'escape' => false)); ?> | <?php echo $this->Html->link('FAQ', "/users/comming_soon", array('class' => 'tab', 'escape' => false)); ?> | <?php echo $this->Html->link('Help', "/users/comming_soon", array('class' => 'tab', 'escape' => false)); ?> 
  			</p>
		</div>
	</div>
	
	<div id="side_bar">
		<div id="tabs">
			<?php echo $this->Html->link('Home', "/users/index", array('class' => 'tab', 'escape' => false)); ?> 
			<?php echo $this->Html->link('Add Books', "/books/add_books", array('class' => 'tab', 'escape' => false)); ?>
			<?php echo $this->Html->link('Find Books', "/books/find_books", array('class' => 'tab', 'escape' => false)); ?>
			<?php echo $this->Html->link('My Library', "/book_initial_offers/my_books", array('class' => 'tab', 'escape' => false)); ?>
		</div>
	</div>
<?php echo $content_for_layout ?>
<?php echo $this->Facebook->init(); ?>
</body>
</html>