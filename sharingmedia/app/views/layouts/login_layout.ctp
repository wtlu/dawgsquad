<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php echo $this->Facebook->html() ?>
<head>
	<title><?php echo $title_for_layout?></title>
	<?php echo $this->Html->css('login'); ?>
</head>
<body>
	
<?php echo $content_for_layout ?>
<?php echo $this->Facebook->init(); ?>
</body>
</html>