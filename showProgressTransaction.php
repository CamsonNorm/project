<?php
//include connection files
include 'connection.php';
//include in php is a language constuct used to include and evalutae the contents of another php file into the current script.
//if the specified file is not found, it generates a warning ut continues to execute the script.
//include can be used to include the same file multiple times.
// require - is similar to include but if the file is missing, it stops from executing the script.
// if the file is crucial for the script to run properly, use 'require', but if the file is optional, use include.

//fetch vehicle list from the database
$sql = "SELECT bookingID, customer_name, customer_phone, customer_email, goods_type, weight, vehicle_type, vehicle_plate, driver_name, 
        driver_id, driverphone, driver_email, driverid_number, pickup_location, dropoff_location, transaction_status, booking_date FROM transactioninfor WHERE transaction_status = 'Pending..'";
$result = $conn->query($sql);
// query is a method call on the $conn object, where $sql is a string containing the SQL statement to be executed.
// query method execute the sql queries againest a database. such as insert, select, delete, update
// it also return the result for the select queries.
// query does not support prepared paramters.

//initialize empty array
$TransactionInfor = array();
if($result->num_rows > 0){
    while($row = $result -> fetch_assoc()){//associative array
         //fetch_assoc(); is a method called on thge result set. it retrieves the next row from the result set and returns it as an associative array.
         //$row is a variable holding the associative array data.
         // -> is an object operator.
        $TransactionInfor[] = $row;
    }
}
header('content-Type: text/plain');
foreach($TransactionInfor as $Transaction){
    echo implode(',', [$Transaction['bookingID'], $Transaction['customer_name'], $Transaction['customer_phone'], $Transaction['goods_type'], 
    $Transaction['weight'], $Transaction['vehicle_type'], $Transaction['vehicle_plate'], $Transaction['pickup_location'], $Transaction['dropoff_location'], 
    $Transaction['driver_id'], $Transaction['driver_name'], $Transaction['driverphone'],  $Transaction['booking_date'],  $Transaction['transaction_status']]). "\n";
    // the implode function is used to concatenat the values of good properties into a single string with each other separated by a comma. 
    // ',' is a string that serves as the delimiter to join array elements. 
}
//close the connection

$conn->close();

?>