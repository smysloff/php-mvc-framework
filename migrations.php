<?php

declare(strict_types=1);

use smysloff\phpmvc\Application;
use Dotenv\Dotenv;

// display errors
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// functions
function dp(mixed $data, bool $die = true): void
{
    if (is_array($data)) {
        foreach ($data as $row) {
            print_r($row);
            echo PHP_EOL;
        }
    } else {
        print_r($data);
        echo PHP_EOL;
    }
    if ($die) die;
}

// autoload
require_once 'vendor/autoload.php';

// .ENV
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// config
$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

// application
$app = new Application(__DIR__, $config);
$app->db->applyMigrations();
//$app->db->pdo->exec('DROP TABLE migrations; DROP TABLE users');
