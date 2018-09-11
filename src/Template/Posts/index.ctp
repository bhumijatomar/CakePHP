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

<body>
   
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
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
           <h2> Hiii ,<?php $session = $this->request->session();
			               $name= $session->read('name');
			                echo $name; 
							 ?></h2>
        </thead>
        <tbody>
        
            <h4>Welcome to Cakephp!!!</h4>
			
        </tbody>
    </table>
   
</div>
