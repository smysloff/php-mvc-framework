<?php

declare(strict_types=1);

use smysloff\phpmvc\Application;

class m0002_add_password_column
{
    public function up()
    {
        $db = Application::$app->db;
        $db->pdo->exec(
            "ALTER TABLE users
                            ADD COLUMN password TEXT NOT NULL"
        );
    }

    public function down()
    {
        $db = Application::$app->db;
        $sql = "
            DROP TABLE IF EXISTS users;
            CREATE TABLE users (
                id INTEGER PRIMARY KEY,
                email TEXT NOT NULL UNIQUE,
                firstname TEXT NOT NULL,
                lastname TEXT NOT NULL,
                status INTEGER NOT NULL,
                created_at TEXT DEFAULT (datetime('now', 'localtime'))
            )
        ";
        $db->pdo->exec($sql);
    }
}