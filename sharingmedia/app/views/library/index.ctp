<!-- File: /app/views/library/index.ctp -->
<?php echo $this->Html->css('main'); ?>

<div id="top_bar_logo">
  <?php echo $this->Html->image('logo.png', array('alt' => 'SharingBooksLogo')) ?>
</div>

<div id="top_bar_options">
  <p>Account | FAQ | Help</p>
</div>

<div id="hello_message">
  <h1>Welcome to SharingBooks!</h1>
  <h2>What would you like to do?</h2>
</div>

<div id="splash_boxes">
  <?php echo $this->Html->image('add_book.png', array('alt' => 'AddBook', 'height' => '250px', 'width' => '250px')) ?>
  <?php echo $this->Html->image('find_book.png', array('alt' => 'FindBook', 'height' => '250px', 'width' => '250px')) ?>
  <?php echo $this->Html->image('my_library.png', array('alt' => 'MyLibrary', 'height' => '250px', 'width' => '250px')) ?>
</div>

<div id="splash_description">
  SharingBooks lets you share, trade, or sell books you own with your friends across Facebook.
</div>
