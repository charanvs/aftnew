<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->call('config:clear');
$kernel->call('cache:clear');
$kernel->call('route:clear');
$kernel->call('view:clear');

echo "Caches cleared";
