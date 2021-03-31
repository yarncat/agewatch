<?php

require_once '../db/init.php';

use App\Validation;

$pdo = new \PDO("sqlite:" . PATH_TO_DATABASE, null, null, $options);

$errorFields = Validation::validate($_POST);

if (!empty($errorFields)) {
    $response = ['errorFields' => $errorFields];
    echo json_encode($response);
} else {
    $values = array_values($_POST);
    $stmt = $pdo->prepare("INSERT INTO users (name, surname, age) VALUES (?, ?, ?)");
    $stmt->execute($values);
    $response = ['success' => "Сохранение данных прошло успешно!"];
    echo json_encode($response);
}
