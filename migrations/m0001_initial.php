<?php

declare(strict_types=1);

use smysloff\phpmvc\Application;

class m0001_initial
{
    public function up()
    {
        $db = Application::$app->db;
        $sql = "
            DROP TABLE IF EXISTS users;
            CREATE TABLE users (
                id INTEGER PRIMARY KEY,
                email TEXT NOT NULL UNIQUE,
                firstname TEXT NOT NULL,
                lastname TEXT NOT NULL,
                status INTEGER NOT NULL DEFAULT 0,
                created_at TEXT DEFAULT (datetime('now', 'localtime'))
            )
        ";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = Application::$app->db;
        $sql = 'DROP TABLE IF EXISTS users';
        $db->pdo->exec($sql);
    }
}
