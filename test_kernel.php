<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';

echo "Step 1: App loaded\n";

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
echo "Step 2: Kernel created\n";

$status = $kernel->handle(
    new Symfony\Component\Console\Input\ArgvInput(['artisan', '--version']),
    new Symfony\Component\Console\Output\ConsoleOutput
);
echo "Step 3: Command executed\n";

exit($status);
