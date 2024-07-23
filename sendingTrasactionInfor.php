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


$bookingid = $_POST['bookingID'];
$customerID = $_POST['user_id'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$vehicleID = $_POST['vehicleID'];
$vehicletype = $_POST['vehicleType'];
$plate = $_POST['vehiclePlate'];
$goodstype = $_POST['goodsType'];
$description = $_POST['description'];
$weight = $_POST['wieght'];
$pickuplocation = $_POST['pickupLocation'];
$dropofflocation = $_POST['dropoffLocation'];
$bookingdate = $_POST['date'];

// Adding the transaction status to nortSorted
$transactionStatus = 'nortSorted';
//geting the current data 
//$currentDateTime = date("Y-m-d H:i:s");

//prepare a SQL statement to inser customer information into database
$sql = "INSERT INTO  TransactionInfor(bookingID, user_id, customer_name, customer_phone, customer_email, vehicleID, vehicle_type, vehicle_plate, goods_type, description, weight, 
        pickup_location, dropoff_location,  booking_date, transaction_status)
        VALUES ('$bookingid', '$customerID', '$name', '$phone', '$email', '$vehicleID', '$vehicletype', '$plate', '$goodstype', '$description', '$weight', '$pickuplocation', '$dropofflocation', '$bookingdate', '$transactionStatus')";
$result = $conn->query($sql);
if($result === TRUE){
    echo "Customer information inserted to database successfully";
} else {
    //error
    echo "Error inserting data" . $sql . "<br>" .$conn->error;
}
//connection
$conn->close();

?>