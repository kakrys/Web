<?php
session_start();
require __DIR__ . '/vendor/autoload.php';

function redirect(){
    header('Location: /');
    exit();
}
if (false === isset($_POST["Email"], $_POST["Title_of_announcement"],
        $_POST["Text_of_announcement"], $_POST["Category"])){
    redirect();
}


$category = $_POST["Category"];
$title = $_POST["Title_of_announcement"];
$text = $_POST["Text_of_announcement"];



$filePath = "categories/{$category}/{$title}.txt";

if (false === file_put_contents($filePath, $text)){
    throw new Exception("Something wrong");
}


$client = new Google_Client();
$client->setApplicationName('Google Sheets in PHP');
$client->setScopes([Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/credentials.json');

$service = new Google_Service_Sheets($client);

/// ЗАПИСЬ В GOOGLE


$data = [
    [
        $category,
        $title,
        $text
    ]
];

$values = new Google_Service_Sheets_ValueRange([
    'values'=>$data
]);
$spreadsheetId = '1OA1jc2-_hL5NX9GExWDkKxJWrgyb4dIRQ-aykvRKKk8';

$result = $service->spreadsheets_values->get($spreadsheetId, 'A:B');
$rows = $result->getValues();

$lI = $rows ? count($rows) + 1 : 1;

$range = 'A'.$lI.':C'.$lI;

$values = new Google_Service_Sheets_ValueRange([
    'values' => $data
]);
$options = [
    'valueInputOption' => 'RAW'
];


$service->spreadsheets_values->update($spreadsheetId, $range, $values, $options);
//////


/// ЧТЕНИЕ ИЗ GOOGLE


$response = $service->spreadsheets_values->get($spreadsheetId, $range);

foreach ($response->getValues() as $item) {
    echo "<tr>";
    echo "<td>".$item[1]."</td>";
    echo "<td>".$item[0]."</td>";
    echo "<td>".$item[2]."</td>";
    echo "</tr>";
}

//////
?>
