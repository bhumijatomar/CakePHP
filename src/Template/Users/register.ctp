<br><br>
<div class="index large-4 medium-4 large-offset-4 medium-offset-4 columns">

     <div class="panel">

        <h2 class="text-center">Register</h2>
        <?= $this->Form->create($user); ?>
		<?= $this->Form->control('firstname'); ?>
		<?= $this->Form->control('lastname'); ?>
        <?= $this->Form->control('email'); ?>
        <?= $ipassword=$this->Form->control('password', array('type'=>'password')); ?>
	    <?= $this->Form->control('confirmpassword', array('type'=>'password')); ?>
		<?= $this->Form->submit('Register', array('class'=>'button')); ?>
	
	   <?= $this->Form->end(); ?>	
	   
	   
     </div>
	 

</div>