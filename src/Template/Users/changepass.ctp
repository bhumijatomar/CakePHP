
<?php 
use Cake\Core\Configure; 


?>

<style>
/* Style all input fields */
input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;
}

/* Style the submit button */
input[type=submit] {
    background-color: #4CAF50;
    color: white;
}

/* Style the container for inputs */
.container {
    background-color: #f1f1f1;
    padding: 20px;
}

/* The message box is shown when the user clicks on the password field */
#message {
    display:none;
    background: #f1f1f1;
    color: #000;
    position: relative;
    padding: 20px;
    margin-top: 10px;
}

#message p {
    padding: 10px 35px;
    font-size: 18px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
    color: green;
}

.valid:before {
    position: relative;
    left: -35px;
    content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
    color: red;
}

.invalid:before {
    position: relative;
    left: -35px;
    content: "✖";
}
</style>

<br><br>
<div class="index large-4 medium-4 large-offset-4 medium-offset-4 columns">
<style>

#disabled
{

       
	}
</style>
     <div class="panel">

        <h2 class="text-center">Change Password</h2>
		<?= $this->Form->create();?>
		  <?php $email_g = $this->request->Session()->read('Auth.User.email');?>
	     <?= $this->Form->input('email',array('type'=>'hidden','default'=>$email_g)); ?>
        <?= $this->Form->input('password', array('type'=>'password','required')); ?>
        <?= $this->Form->input('new_password', array('type'=>'password','required','pattern'=>'(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}', 'id'=>'new_password', 
		                       'title'=>'Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters')); ?>
        <?= $this->Form->input('confirm_password', array('type'=>'password','required','id'=>'confirm_password' )); ?>
		 
			<?= $this->Form->submit('changepass', array('class'=>'button')); ?>
		   
		
	   <?= $this->Form->end(); ?>	
     </div>

</div>


<script>
  var password = document.getElementById("new_password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(new_password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

new_password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
  </script>