<?php
// artisan2.php - Alternative Artisan CLI
define('LARAVEL_START', microtime(true));

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

// Simple command handler
$args = $_SERVER['argv'];
$command = $args[1] ?? '--help';

// Handle basic commands
switch ($command) {
    case '--version':
    case '-V':
        echo "Laravel Framework 10.48.29\n";
        exit(0);

    case 'make:model':
        $name = $args[2] ?? null;
        if (!$name) {
            echo "Error: Model name required\n";
            exit(1);
        }
        makeModel($name);
        exit(0);

    case 'make:controller':
        $name = $args[2] ?? null;
        if (!$name) {
            echo "Error: Controller name required\n";
            exit(1);
        }
        makeController($name);
        exit(0);

    case 'migrate':
        runMigrations();
        exit(0);

    case '--help':
    default:
        showHelp();
        exit(0);
}

// Fungsi pembantu
function makeModel($name)
{
    $stub = <<<'EOT'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class {className} extends Model
{
    use HasFactory;

    protected $fillable = [];
}
EOT;

    $stub = str_replace('{className}', $name, $stub);
    $path = __DIR__ . "/app/Models/$name.php";

    if (file_exists($path)) {
        echo "Model already exists!\n";
        exit(1);
    }

    // Pastikan directory exists
    if (!is_dir(dirname($path))) {
        mkdir(dirname($path), 0755, true);
    }

    file_put_contents($path, $stub);
    echo "Model created successfully: app/Models/$name.php\n";
}

function makeController($name)
{
    $stub = <<<'EOT'
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class {className} extends Controller
{
    //
}
EOT;

    $stub = str_replace('{className}', $name, $stub);
    $path = __DIR__ . "/app/Http/Controllers/$name.php";

    if (file_exists($path)) {
        echo "Controller already exists!\n";
        exit(1);
    }

    // Pastikan directory exists
    if (!is_dir(dirname($path))) {
        mkdir(dirname($path), 0755, true);
    }

    file_put_contents($path, $stub);
    echo "Controller created successfully: app/Http/Controllers/$name.php\n";
}

function runMigrations()
{
    $app = require __DIR__ . '/bootstrap/app.php';
    $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

    $migrator = $app->make('migrator');
    $migrator->run([database_path('migrations')]);

    echo "Migrations completed!\n";
}

function showHelp()
{
    echo "Laravel Artisan (Alternative)\n\n";
    echo "Available commands:\n";
    echo "  --version, -V          Show Laravel version\n";
    echo "  make:model <name>      Create a new model class\n";
    echo "  make:controller <name> Create a new controller class\n";
    echo "  migrate                Run database migrations\n";
    echo "  --help                 Show this help message\n";
}
