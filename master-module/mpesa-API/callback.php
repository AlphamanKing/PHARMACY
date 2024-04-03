<?php

echo '<a href="index.php">Home<br /></a>';

$content = file_get_contents('php://input'); // Receives the JSON Result from Safaricom
$res = json_decode($content, true); // Convert the JSON to an array

$dataToLog = array(
    date("Y-m-d H:i:s"), // Date and time
    "MerchantRequestID: " . $res['Body']['stkCallback']['MerchantRequestID'],
    "CheckoutRequestID: " . $res['Body']['stkCallback']['CheckoutRequestID'],
    "ResultCode: " . $res['Body']['stkCallback']['ResultCode'],
    "ResultDesc: " . $res['Body']['stkCallback']['ResultDesc'],
);

$data = implode(" - ", $dataToLog);
$data .= PHP_EOL;
file_put_contents('transaction_log.txt', $data, FILE_APPEND); // Logs the results to our log file

// Saves the result to the database
$conn = new PDO("mysql:host=localhost;dbname=HALISI_PHARMACY_MGT_SYS", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->query("SELECT * FROM orders ORDER BY ID DESC LIMIT 1");
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row) {
    $ID = $row['ID'];

    if ($res['Body']['stkCallback']['ResultCode'] == '1032') {
        $sql = $conn->prepare("UPDATE `orders` SET `Status` = 'CANCELLED' WHERE `ID` = ?");
        $rs = $sql->execute([$ID]);
    } else {
        $sql = $conn->prepare("UPDATE `orders` SET `Status` = 'SUCCESS' WHERE `ID` = ?");
        $rs = $sql->execute([$ID]);
    }

    if ($rs) {
        file_put_contents('error_log.txt', "Records Inserted" . PHP_EOL, FILE_APPEND);
    } else {
        file_put_contents('error_log.txt', "Failed to insert Records" . PHP_EOL, FILE_APPEND);
    }
}
