<h1>LOGIN</h1>

<?= $this->Facebook->login(); ?>

<?php echo $this->Session->read('uid'); ?>