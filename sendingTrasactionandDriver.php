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
 if($_SERVER["REQUEST_METHOD"] =="POST"){
    $driverID = $_POST['driverID'];
    $driverName = $_POST['driverName'];
    $driverEmail = $_POST['email'];
    $driverPhone = $_POST['phone'];
    $driverIdnumber = $_POST['idnumber'];
    $bookingID = $_POST['bookingID'];
    $vehicleID = $_POST['vehicleID'];
    $status = 'Pending..';
   //prepare a SQL statement to update TransactionInfor
   $sql = "UPDATE TransactionInfor SET vehicleID = '$vehicleID', driver_id = '$driverID', driver_name = '$driverName', driverphone = '$driverPhone',
           driver_email = '$driverEmail', driverid_number = '$driverIdnumber',  transaction_status = '$status' WHERE bookingID   = $bookingID";
   if ($conn->query($sql) === TRUE) {
   
    echo "Driver selected successffully!";
   } else {
 
    echo "Error Updating" .$conn->error;
   }

} else{
    echo "NO DATA RECIEVED";
}
$conn->close();
?>

