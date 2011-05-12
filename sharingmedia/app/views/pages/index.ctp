<!-- File: /app/views/user/index.ctp -->

LOGIN

<div id="login">
			<h2<?php __('Users Home'); ?></h2>
			<?php
			$uid=$this->Session->read('uid');
			if(!empty($uid)){
				echo "<img src=\"https://graph.facebook.com/$uid/picture\"/>";
				echo "<h3>Welcome ".$this->Session->read('username')."</h3>";
				echo "</br>";
				echo "</br>";
				echo $this->Html->link('Logout',array('controller'=>'users','action'=>'logout'));
				echo "</hr>";
			}else{
				echo $this->Html->link('Login',array('controller'=>'users','action'=>'login'));
			}
			?>


</div>