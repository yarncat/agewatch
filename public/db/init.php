<?php

require_once "../../vendor/autoload.php";

const PATH_TO_DATABASE = "../db/database.db";

$options = [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC];

if (!file_exists(PATH_TO_DATABASE)) {
    $pdo = new \PDO("sqlite:" . PATH_TO_DATABASE, null, null, $options);
    $pdo->exec("CREATE TABLE users (id INTEGER PRIMARY KEY, name TEXT, surname TEXT, age INTEGER)");

    $pdo->exec("INSERT INTO users (name, surname, age)
                VALUES ('Константин', 'Анисимов', 45),
                       ('Николай', 'Линевич', 56),
                       ('Евгения', 'Алексеева', 37),
                       ('Екатерина', 'Ефремова', 17),
                       ('Алексей', 'Ермолов', 15)");
}
