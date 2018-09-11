<?php 
use Cake\Core\Configure; 
$this->Form->setTemplates(['inputContainer' => '<div class="col-sm-12">{{content}}</div>']);
?>
<
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="custom-form pd-top-10">
					<h3 class="custom-field">Change Password</h3>
					<?= $this->Form->create('', ['autocomplete' => 'off', 'id' => 'changePass', 'class' => 'form-horizontal']) ?>
	                    <div class="form-group">
							<?php echo $this->Form->input('current_password', ['label'=>false, 'type'=>'password', 'maxlength' => 150, 'class' => 'custom-field', 'placeholder'=>"Current Password"]); ?>
	                    </div>
	                    <div class="form-group">
							<?php echo $this->Form->input('password', ['label'=>false, 'maxlength' => 150, 'class' => 'custom-field', 'placeholder'=>"New Password"]); ?>
	                    </div>
	                     <div class="form-group">
							<?php echo $this->Form->input('confirm_password', ['label'=>false, 'type'=>'password', 'maxlength' => 150, 'class' => 'custom-field', 'placeholder'=>"Confirm Password"]); ?>
	                    </div>
	                    <div class="form-group pd-top-20 pd-btm-20">
	                    	<div class="col-sm-12">
	                    		<input type="submit" class="btn btn-default" value="Change Password">
	                    	</div>
	                    </div>
					<?php echo $this->Form->hidden('type', ['value'=>"change_password"]); ?>
					<?= $this->Form->end() ?>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
$(document).ready(function () {
	$("#profile").validate({
		rules: {
			phone: {
				required: true
			},
			first_name: {
				required: true,
				alphanumericspace: true
			},
			last_name: {
				required: true,
				alphanumericspace: true
			},
			state: {
				required: true,
				alphanumericspace: true
			},
			country: {
				required: true,
				alphanumericspace: true
			}
		},
		messages: {
			phone: {
				required: 'Please enter your phone number.'
			},
			first_name: {
				required: 'Please enter your first name.',
				alphanumericspace: 'Special characters are not allowed.'
			},
			last_name: {
				required: 'Please enter your last name.',
				alphanumericspace: 'Special characters are not allowed.'
			},
			state: {
				required: 'Please enter your state.',
				alphanumericspace: 'Special characters are not allowed.'
			},
			country: {
				required: 'Please enter your country.',
				alphanumericspace: 'Special characters are not allowed.'
			}
		}
	});

	$("#changePass").validate({
		rules: {
			current_password: {
				required: true
			},
			password: {
				required: true
			},
			confirm_password: {
				required: true,
				equalTo: "#password"
			}
		},
		messages: {
			current_password: {
				required: "Please enter your current password."
			},
			password: {
				required: "Please enter new password."
			},
			confirm_password: {
				required: "Please enter confirm password.",
				equalTo: "Confirm password should match with new password."
			}
		}
	});
});
</script>