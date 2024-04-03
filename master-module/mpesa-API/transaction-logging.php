<?php
session_start();
include 'db.php'; // Include your database connection file

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if transactionID is set and not empty
    if (isset($_POST['transactionID']) && !empty($_POST['transactionID'])) {
        // Assign variables from session and POST data
        $phone = $_SESSION['phone_number'];
        $amount = $_SESSION['total_amount'];
        $transactionID = $_POST['transactionID'];

        // Prepare an insert statement
        $sql = "INSERT INTO transaction_log (Phone, TRANSACTION_ID, amount) VALUES (?, ?, ?)";

        if ($stmt = $con->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssd", $phone, $transactionID, $amount);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to receipt page on successful insertion
                header("Location: receipt.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    } else {
        echo "Transaction ID is required.";
    }
} else {
    echo "Form not submitted correctly.";
}

// Close connection
$con->close();
