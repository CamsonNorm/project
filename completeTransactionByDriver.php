<?php
//start a session 
//session_start();
session_start();
// Include the database connection file 
include 'connection.php';
//include in php is a language constuct used to include and evalutae the contents of another php file into the current script.
//if the specified file is not found, it generates a warning ut continues to execute the script.
//include can be used to include the same file multiple times.
// require - is similar to include but if the file is missing, it stops from executing the script.
// if the file is crucial for the script to run properly, use 'require', but if the file is optional, use include.

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //$_SERVER - is a superglobal variable in PHP that holds information about server environment and the current request.
    // it is an associative array that contain information such as headers, paths, and script locations.
   //$_SERVER["REQUEST_METHOD"]-holds a request method that is used to access the page example, "GET", "POST", "PUT","DELETE"
   $transactID = $_POST['staff_id'];
   $payment_method = $_POST['paymnetMethod'];
   $payment_number =  $_POST['payment_number'];
   $payment_code = $_POST['payment_code'];
   $amount_paid = $_POST['amount_paid'];
   $time_taken = $_POST['time_taken'];
   $payment_status = 'Paid';
   $transaction_status = 'Completed';
    //prepare a SQL statement to update TransactionInfor
    $sql = "UPDATE TransactionInfor SET payment_method = '$payment_method', payment_number = '$payment_number',  payment_code = '$payment_code',
    amoun_paid = '$amount_paid', time_taken = '$time_taken', payment_status = '$payment_status', transaction_status = '$transaction_status'  WHERE TransactionID = $transactID";
    if ($conn->query($sql) === TRUE) {
      
        echo "Transaction completed successffully!";
    } else {
     
        echo "Error Updating" .$conn->error;
    } 
} 
else {
  ;
    echo "Invalid reguest";
}
$conn->close();
?>
