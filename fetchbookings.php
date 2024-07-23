<?php
// include the connection file
include 'connection.php';
//include in php is a language constuct used to include and evalutae the contents of another php file into the current script.
//if the specified file is not found, it generates a warning ut continues to execute the script.
//include can be used to include the same file multiple times.
// require - is similar to include but if the file is missing, it stops from executing the script.
// if the file is crucial for the script to run properly, use 'require', but if the file is optional, use include.

//fetch booking information from database
$sql = "SELECT bookinginformation. *, user_table.* FROM bookinginformation INNER JOIN user_table ON bookinginformation.user_id = user_table.user_id WHERE booking_status = 'sendToAdmim' ";
$result = $conn->query($sql);
// query is a method call on the $conn object, where $sql is a string containing the SQL statement to be executed.
// query method execute the sql queries againest a database. such as insert, select, delete, update
// it also return the result for the select queries.
// query does not support prepared paramters.
$bookings = array();
if($result->num_rows > 0){
     //check if the result obtained from the prepared statement contain exactly one row.
     //num_rows is a property of the result set object ('$result') that returns the number of rows in the result set.
    while($row = $result -> fetch_assoc()){
        //fetch_assoc(); is a method called on the result set. it retrieves the next row from the result set and returns it as an associative array.
        //$row is a variable holding the associative array data.
        $bookings[] = $row;
    }
}
header('content-Type: text/plain');
foreach($bookings as $booking){
    echo implode(',', [$booking['bookingID'], $booking['user_id'], $booking['first_name'], $booking['email'], $booking['phone'], 
    $booking['vehicleType'], $booking['vehicleID'], $booking['vehiclePlate'], $booking['goodsType'], $booking['description'],
    $booking['wieght'], $booking['pickupLocation'], $booking['dropoffLocation'], $booking['date']]). "\n";
    // the implode function is used to concatenat or join the values of booking properties into a single string with each other separated by a comma. 
    // ',' is a string that serves as the delimiter to join array elements. 
}
$conn->close();
?>