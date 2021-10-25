<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Jobs;

if(!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: index.php?status=error');
    exit;
}

$newJob = Jobs::getJob($_GET['id']); 

if(!$newJob instanceof Jobs) {
    header('location: index.php?status=error');
    exit;
}

if(isset($_POST['delete'])) {
    
    $newJob->delete();

    header('location: index.php?status=success');
    exit;
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/confirm-delition.php';
include __DIR__.'/includes/footer.php';