<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$errors  = array();
$errmsg  = '';

$config = array(
    "env"              => "sandbox",
    "BusinessShortCode"=> "174379",
    "key"              => "yXXSNGKMgycy63JpUhqc1vu05ZKloyDNg4AwcePcvE3PXkGH", //Enter your consumer key here
    "secret"           => "evwEatnrHch9AFChWenoesAiFQkaQMRUWSZ5R2WDIilHGnFA3qn8cAZkriVgBhFL", //Enter your consumer secret here
    "username"         => "apitest",
    "TransactionType"  => "CustomerPayBillOnline",
    "passkey"          => "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919", //Enter your passkey here
    "CallBackURL"      => "https://d734-102-217-157-218.ngrok-free.app/callback.php", //Use Ngrok for localhost
    "AccountReference" => "CompanyXLTD",
    "TransactionDesc"  => "Payment of X" ,
);

if (isset($_POST['phone_number'])) {

    $phone = $_POST['phone_number'];
    $amount = $_SESSION['total_amount'];
    $userEmail = $_SESSION['email'];

    $phone = (substr($phone, 0, 1) == "+") ? str_replace("+", "", $phone) : $phone;
    $phone = (substr($phone, 0, 1) == "0") ? preg_replace("/^0/", "254", $phone) : $phone;
    $phone = (substr($phone, 0, 1) == "7") ? "254{$phone}" : $phone;

    $access_token_url = ($config['env']  == "live") ? 
        "https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials" : 
        "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials"; 
    $credentials = base64_encode($config['key'] . ':' . $config['secret']); 
    
    $ch = curl_init($access_token_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Basic " . $credentials]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $response = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($response); 
    $token = isset($result->{'access_token'}) ? $result->{'access_token'} : "N/A";

    $timestamp = date("YmdHis");
    $password  = base64_encode($config['BusinessShortCode'] . $config['passkey'] . $timestamp);

    $curl_post_data = array( 
        "BusinessShortCode" => $config['BusinessShortCode'],
        "Password" => $password,
        "Timestamp" => $timestamp,
        "TransactionType" => $config['TransactionType'],
        "Amount" => $amount,
        "PartyA" => $phone,
        "PartyB" => $config['BusinessShortCode'],
        "PhoneNumber" => $phone,
        "CallBackURL" => $config['CallBackURL'],
        "AccountReference" => $config['AccountReference'],
        "TransactionDesc" => $config['TransactionDesc'],
    ); 

    $data_string = json_encode($curl_post_data);

    $stk_push_url = ($config['env'] == "live") ? 
        "https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest" : 
        "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest"; 

    $ch = curl_init($stk_push_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer '.$token,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response     = curl_exec($ch);
    curl_close($ch);

    $result = json_decode(json_encode(json_decode($response)), true);

    if(!preg_match('/^[0-9]{10}+$/', $phone) && array_key_exists('errorMessage', $result)){
        $errors['phone'] = $result["errorMessage"];
    }

    if($result['ResponseCode'] === "0"){         //STK Push request successful

        $MerchantRequestID = $result['MerchantRequestID'];
        $CheckoutRequestID = $result['CheckoutRequestID'];

        //Saves your request to a database
        require 'db.php';
       // $conn = mysqli_connect("localhost","root","","ecommerce");
       
       $sql = "INSERT INTO `orders` (`Email`, `Amount`, `Phone`, `CheckoutRequestID`, `MerchantRequestID`) VALUES ('".$userEmail."','".$amount."','".$phone."','".$CheckoutRequestID."','".$MerchantRequestID."');";
        
        if ($con->query($sql) === TRUE){
            $_SESSION["MerchantRequestID"] = $MerchantRequestID;
            $_SESSION["CheckoutRequestID"] = $CheckoutRequestID;
            $_SESSION["phone_number"] = $phone;
            $_SESSION["email"] = $userEmail;

            header('location: confirm-payment.php');
        }else{
            $errors['database'] = "Unable to initiate your order: ".$con->error;  
            foreach($errors as $error) {
                $errmsg .= $error . '<br />';
            } 
        }
        
    }else{
        $errors['mpesastk'] = $result['errorMessage'];
        foreach($errors as $error) {
            $errmsg .= $error . '<br />';
        }
    }
}
