<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php echo $this->Facebook->html() ?>
<head>
	<title><?php echo $title_for_layout?></title>
	<?php echo $scripts_for_layout ?>
	<?php echo $this->Html->css('layout'); ?>
	<?php header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');?>
<!--
	<script type="text/javascript">
	window.fbAsyncInit = function() {
	FB.Canvas.setSize();
	}
	// Do things that will sometimes call sizeChangeCallback()
	function sizeChangeCallback() {
	FB.Canvas.setSize();
	}
	</script>
-->
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

<!--
<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
FB.init({
appId : '218244414868504',
status : true, // check login status
cookie : true, // enable cookies to allow the server to access the session
xfbml : true // parse XFBML
});
</script>
-->
</body>
</html>
