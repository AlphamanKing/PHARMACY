<?php
header("Content-Type:application/json");

// Configuration settings
$env = "sandbox";
$type = 4;
$shortcode = '174379';
$key = "yXXSNGKMgycy63JpUhqc1vu05ZKloyDNg4AwcePcvE3PXkGH"; // Enter your key here
$secret = "evwEatnrHch9AFChWenoesAiFQkaQMRUWSZ5R2WDIilHGnFA3qn8cAZkriVgBhFL"; // Enter your secret here
$initiatorName = "testapi";
$initiatorPassword = "Safaricom978!";
$results_url = "https://mydomain.com/TransactionStatus/result/"; // Endpoint to receive results
$timeout_url = "https://mydomain.com/TransactionStatus/queue/"; // Endpoint for timeout

// Ensure transaction code is provided
if (!isset($_POST["transactionID"])) {
    echo "Oops! You did not enter the transaction code!";
    exit();
}

$transactionID = $_POST["transactionID"];
$command = "TransactionStatusQuery";
$remarks = "Transaction Status Query";
$occasion = "Transaction Status Query";

// Access token request
$access_token_url = ($env == "live") ?
    "https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials" :
    "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
$credentials = base64_encode($key . ':' . $secret);

$ch = curl_init($access_token_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Basic " . $credentials]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response);
$token = isset($result->access_token) ? $result->access_token : "N/A";

// Encrypt initiator password
$publicKey = file_get_contents(__DIR__ . "/mpesa_public_cert.cer");
openssl_public_encrypt($initiatorPassword, $encrypted, $publicKey, OPENSSL_PKCS1_PADDING);
$password = base64_encode($encrypted);

// Transaction status request
$curl_post_data = array(
    "Initiator" => $initiatorName,
    "SecurityCredential" => $password,
    "CommandID" => $command,
    "TransactionID" => $transactionID,
    "PartyA" => $shortcode,
    "IdentifierType" => $type,
    "ResultURL" => $results_url,
    "QueueTimeOutURL" => $timeout_url,
    "Remarks" => $remarks,
    "Occasion" => $occasion,
);

$data_string = json_encode($curl_post_data);

$endpoint = ($env == "live") ?
    "https://api.safaricom.co.ke/mpesa/transactionstatus/v1/query" :
    "https://sandbox.safaricom.co.ke/mpesa/transactionstatus/v1/query";

$ch2 = curl_init($endpoint);
curl_setopt($ch2, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $token,
    'Content-Type: application/json'
]);
curl_setopt($ch2, CURLOPT_POST, 1);
curl_setopt($ch2, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch2);
curl_close($ch2);

$result = json_decode($response);

// Check transaction status
$verified = $result->ResponseCode;
if ($verified === "0") {
    header('location: receipt.php');
    // echo "Transaction verified as TRUE";
} else {
    echo "Transaction doesn't exist.";
}
