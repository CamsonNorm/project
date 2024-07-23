<?php
session_start();
// used to start a new session
// a session is a way to store information in variable to e used across multiple pages 
include 'connection.php';
//include in php is a language constuct used to include and evalutae the contents of another php file into the current script.
//if the specified file is not found, it generates a warning ut continues to execute the script.
//include can be used to include the same file multiple times.
// require - is similar to include but if the file is missing, it stops from executing the script.
// if the file is crucial for the script to run properly, use 'require', but if the file is optional, use include.

if (!isset($_SESSION['username'])) {
    header("Location: home.html");
    exit();
}

// Retrieve and sanitize input data for senting
$user_id = trim($_POST['user_id']);
$goodsStatus = trim($_POST['goodsStatus']);
$quantity = trim($_POST['quantity']);
$volume = trim($_POST['volume']);
$weight = trim($_POST['weight']);
$pickupLocation = trim($_POST['pickupLocation']);
$dropOffLocation = trim($_POST['dropOffLocation']);
$description = trim($_POST['description']);
$vehicle_ID = trim($_POST['vehicle_ID']);
$vehicleType = trim($_POST['vehicle_type']);
$plate = trim($_POST['vehicle_plate']);
$capacity = trim($_POST['vehicle_capacity']);

$date = date('Y-m-d H:i:s'); 
$bookingStatus = 'sendToAdmim';
$vehi_status = 'BOOKED';

// Prepare a SQL statement to insert customer information into the database
$sql = "INSERT INTO bookinginformation(user_id, goodsType, quantity, volume, wieght, description, pickupLocation, dropoffLocation, vehicleID, vehicleType, vehiclePlate, vehiclleCapacity, date, booking_status, vehicleStatus)
        VALUES ('$user_id', '$goodsStatus', '$quantity', '$volume', '$weight', '$description', '$pickupLocation', '$dropOffLocation', '$vehicle_ID', '$vehicleType', '$plate', '$capacity', '$date', '$bookingStatus', '$vehi_status')";

if ($conn->query($sql) === TRUE) {
    echo "Booking information sent successfully";
} else {
    echo "Error sending data: " . $conn->error;
}

$conn->close();
?>
