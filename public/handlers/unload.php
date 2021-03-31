<?php

require_once '../db/init.php';

$pdo = new \PDO("sqlite:" . PATH_TO_DATABASE, null, null, $options);

$stmt = $pdo->prepare("SELECT surname, name, age FROM users WHERE age > 18 ORDER BY surname");
$stmt->execute();
$values = $stmt->fetchAll(PDO::FETCH_NUM);

$client = new \Google_Client();
$client->setApplicationName('agewatch');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig('../../credentials.json');

$service = new Google_Service_Sheets($client);
$spreadsheetId = "1T1CeaOt0D8vkWhk13DgVAkT3VVcmBU7Jy_abSu1liC4";
$range = "A2:C";
$body = new Google_Service_Sheets_ValueRange(['values' => $values]);
$params = ['valueInputOption' => 'RAW'];

$requestBody = new Google_Service_Sheets_ClearValuesRequest();
$response = $service->spreadsheets_values->clear($spreadsheetId, $range, $requestBody);
$result = $service->spreadsheets_values->update($spreadsheetId, $range, $body, $params);

if (isset($result['updatedCells'])) {
    $response = ['success' => "Данные по запросу выгружены успешно",
                    'link' => "https://docs.google.com/spreadsheets/d/$spreadsheetId"];
    echo json_encode($response);
} else {
    $response = ['message' => "База не содержит записей, удовлетворяющих условию"];
    echo json_encode($response);
}
