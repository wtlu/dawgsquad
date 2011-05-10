<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
  			<p>Account | FAQ | Help</p>
		</div>
	</div>
	
	<div id="side_bar">
		<div id="tabs">
			<?php echo $this->Html->link('Home', 'http://localhost/sharingmedia/index.php', array('class' => 'tab')); ?> 
			<?php echo $this->Html->link('Add Books', 'http://localhost/sharingmedia/index.php/books/add_books', array('class' => 'tab')); ?>
			<?php echo $this->Html->link('Find Books', 'http://localhost/sharingmedia/index.php/find_books', array('class' => 'tab')); ?>
			<?php echo $this->Html->link('My Library', 'http://localhost/sharingmedia/index.php/my_library', array('class' => 'tab')); ?>
		</div>
	</div>
<?php echo $content_for_layout ?>
</body>
</html>