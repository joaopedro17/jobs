<?php

require __DIR__ . '/vendor/autoload.php';

use App\Entity\Jobs;

$jobs = Jobs::getJobs();

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/list.php';
include __DIR__ . '/includes/footer.php';
