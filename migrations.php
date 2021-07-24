<?php

declare(strict_types=1);

use app\models\User;
use smysloff\phpmvc\Application;
use Dotenv\Dotenv;

// display errors
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// autoload
require_once 'vendor/autoload.php';

// .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// config
$config = [
    'userClass' => User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

// application
$app = new Application(__DIR__, $config);
$app->db->applyMigrations();
