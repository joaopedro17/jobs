<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE', 'Register a new job');

use \App\Entity\Jobs;

$newJob = new Jobs;

if(isset($_POST['title'],$_POST['description'],$_POST['active'])) {
    
    $newJob->title = $_POST['title'];
    $newJob->description = $_POST['description'];
    $newJob->active = $_POST['active'];
    $newJob->Register();

    header('location: index.php?status=success');
    exit;
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/form.php';
include __DIR__.'/includes/footer.php';