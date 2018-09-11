<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
 <script>
              $(function() {
    $('#profile-image1').on('click', function() {
        $('#profile-image-upload').click();
    });
});       
</script> 



<body>
    
    <?= $this->Flash->render() ?>
   
    <footer>
    </footer>
</body>
</html>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('My Account') ?></li>
        <li><?= $this->Html->link(__('Profile'), ['action' => 'profile']) ?></li>
        <li><?= $this->Html->link(__('Change Password'), ['controller' => 'users', 'action' => 'changepass']) ?></li>
        <li><?= $this->Html->link(__('New Post'), ['controller' => 'Posts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('CakePHP') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
		        
  <div class="col-md-7 ">

<div class="panel panel-default">
  <div class="panel-heading">  <center><h4 >My Profile</h4></center></div>
 <div class="panel-body">
       
    <div class="box box-info">
        
            <div class="box-body">
	    <h1>Upload file</h1>
		<div class="content">
		   <?= $this->Flash->render(); ?>
		   <div class="upload-form">
		     <?= $this->Form->create($post,['type'=>'file']); ?>
			 
			 <img src="<?php $session = $this->request->session();
                			 $img= $session->read('path');
			                  echo $img; ?>"style="height:180px; width:200px;">
							
			 <?= $this->Form->input('file',['type'=>'file', 'class'=>'form-control'],'required'); ?>
			 
			 <?= $this->Form->button(__('Upload File'),['type'=>'submit','class'=>'form-controlbtn btn-default']); ?>
			 <?= $this->Form->end(); ?>
		   </div>
		</div>
	 </div>	

			 
            </div>
         <br>
    </div>
			 
            <div class="col-sm-6">
               <center><h4 style="color:#00b1b1;"><?php $session = $this->request->session();
			                                            $name= $session->read('name');
			                                              echo $name; ?> 
					    </h4>
			    <center>       
            </div>
    <div class="clearfix"></div>
      <hr style="margin:5px 0 5px 0;">
    
        <div class="col-sm-5 col-xs-6 tital " ><b> Name:</b></div>
		    <div class="col-sm-7 col-xs-6 ">
              <?php  $session = $this->request->session();
			         $name= $session->read('name');
			          echo $name;					 ?>  
			</div>
        <div class="clearfix"></div>
             <div class="bot-border"></div>

    <div class="col-sm-5 col-xs-6 tital " ><b>Email:</b></div>
	<div class="col-sm-7"><?= $userEmail = $this->request->Session()->read('Auth.User.email'); ?></div>
           <div class="clearfix"></div>
           <div class="bot-border"></div>
 </div>
</div>     
</div> 
    </div> 
</thead>

    <tbody>
     
    </tbody>
</table>
<?php

 
			  $img= $session->read('path');
			  //echo $img;

?>




   <style>
   input.hidden {
    position: absolute;
    left: -9999px;
}

#profile-image1 {
    cursor: pointer;
  
     width: 100px;
    height: 100px;
	border:2px solid #03b1ce ;}
	.tital{ font-size:16px; font-weight:500;}
	 .bot-border{ border-bottom:1px #f8f8f8 solid;  margin:5px 0  5px 0}	
	 </style>
