<h1>Home Page</h1>

<?php if($facebook_user): ?>
	<?php echo $this->Facebook->logout(array('redirect' => array('controller' => 'users','action' => 'logout'))); ?>
	<?= debug($facebook_user); ?>
	<?= debug($user); ?>
<?php else: ?>
	<?php echo $this->Facebook->login(); ?>
<?php endif; ?>
