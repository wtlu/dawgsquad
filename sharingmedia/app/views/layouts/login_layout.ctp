<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php echo $this->Facebook->html() ?>
<head>
	<title><?php echo $title_for_layout?></title>
	<?php echo $this->Html->css('login'); ?>
</head>
<body>

	<div id="top_section">
	
		<div id="top_bar_logo">
		
 			<?php echo $this->Html->image('logo.png', array('alt' => 'SharingBooksLogo')) ?>
		</div>
	</div>
	
<?php echo $content_for_layout ?>
</body>
</html>