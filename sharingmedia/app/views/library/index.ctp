<!-- File: /app/views/library/index.ctp -->

<!-- 
     Author: Greg Brandt
     Purpose: This is a dummy splash page for ZFR
 -->

<?php echo $this->Html->css('main'); ?>

<div id="top_bar_logo">
  <?php echo $this->Html->image('logo.png', array('alt' => 'SharingBooksLogo')) ?>
</div>

<div id="top_bar_options">
  <p>Account | FAQ | Help</p>
</div>

<div id="hello_message">
  <h1>Welcome to SharingMedia!</h1>
  <h2>What would you like to do?</h2>
</div>

<div id="splash_boxes">
  <?php echo $this->Html->image('add_book.png', array('alt' => 'AddBook')) ?>
  <?php echo $this->Html->image('find_book.png', array('alt' => 'FindBook')) ?>
  <?php echo $this->Html->image('my_library.png', array('alt' => 'MyLibrary')) ?>
</div>

<div id="splash_description">
  SharingMedia lets you share, trade, or sell books you own with your friends across Facebook.
</div>
