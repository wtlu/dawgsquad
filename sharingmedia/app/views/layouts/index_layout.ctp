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
  			<p><?php 
				echo $this->Html->link('About', "http://code.google.com/p/dawgsquad/", array('class' => 'button', 'target' => '_blank')); 
				echo $this->Html->link('Report bugs', "http://code.google.com/p/dawgsquad/issues/entry", array('class' => 'button', 'target' => '_blank')); 
				echo $this->Html->link('Help', 'http://code.google.com/p/dawgsquad/wiki/UserDocumentation', array('class' => 'button', 'target' => '_blank')); 
				?>
  			</p>
		</div>
	</div>
<?php echo $content_for_layout ?>
<?php echo $this->Facebook->init(); ?>
</body>
</html>