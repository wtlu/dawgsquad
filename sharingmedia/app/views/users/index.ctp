<!-- File: /app/views/user/index.ctp -->

<!-- 
     Author: Greg Brandt
     Purpose: This is a dummy splash page for ZFR
	 
	 Changelog:
	 5/3/2011 - James Parsons - Moved to /user
	 5/8/2011 - Troy Martin - Adding list under buttons to describe what the button allows the user to do
	 5/8/2011 - John Wang - Added link to add books
	 
	 <?php echo $this->Html->css('main', array('inline' => 'false')); ?>
	 <?php echo $this->Html->css('main', NULL, array('inline' => FALSE)); ?>
 -->
 
 	
	

<div id="hello_message">
  <h1>Welcome to SharingMedia!</h1>
  <h2>What would you like to do?</h2>
</div>

<div id="splash_boxes">
	<div class="box">
		
  		<?php 
		  echo $this->Html->link(
		  	$this->Html->image('add_book.png', array('alt' => 'AddBook')),
		  	"/books/add_books",
		  	array('escape' => false)
		  );
  		?>
  		
  		<ul>
  			<li>Add books to your library</li>
  		</ul>	
  	</div>
  	
  	<div class="box">
  	
  		<?php echo $this->Html->image('find_book.png', array('alt' => 'FindBook')) ?>
  		
  		<ul>
  			<li>Find books you need</li>
  		</ul>
  	</div>
  	
  	<div class="box">
  	
  		<?php echo $this->Html->image('my_library.png', array('alt' => 'MyLibrary')) ?>
  		
  		<ul>
  			<li>View the books in your library</li>
  			<li>View your transactions</li>
  			<li>View your current loans</li>
  		</ul>
  	</div>
</div>

<div id="splash_description">
  SharingMedia lets you share, trade, or sell books you own with your friends across Facebook. For more information, including how to get the latest build, please visit <?php echo $this->Html->link('our wiki', 'http://code.google.com/p/dawgsquad/', array('class' => 'button', 'target' => '_blank')); ?>
</div>