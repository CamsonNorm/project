<?php
//start a session 
//session_start();
session_start();
// Include the database connection file 
include 'connection.php';
//include in php is a language constuct used to include and evalutae the contents of another php file into the current script.
//if the specified file is not found, it generates a warning but continues to execute the script.
//include can be used to include the same file multiple times.
// require - is similar to include but if the file is missing, it stops from executing the script.
// if the file is crucial for the script to run properly, use 'require', but if the file is optional, use include.
    $vehicle_ID =  $_POST['vehicle_ID'];
   //prepare a SQL statement to update TransactionInfor
   $sql = "DELETE FROM vehicle  WHERE vehicleID = $vehicle_ID";
   if ($conn->query($sql) === TRUE) {
    http_response_code(200);
    echo "vehicle Deleted successffully!";
   } else {
    http_response_code(500);
    echo "Error Updating" .$conn->error;
   }
$conn->close();
?>