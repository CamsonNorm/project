<?php
//include connection files
include 'connection.php';
//include in php is a language constuct used to include and evalutae the contents of another php file into the current script.
//if the specified file is not found, it generates a warning ut continues to execute the script.
//include can be used to include the same file multiple times.
// require - is similar to include but if the file is missing, it stops from executing the script.
// if the file is crucial for the script to run properly, use 'require', but if the file is optional, use include.

if(isset($_GET['staff_id'])){
    // converting staff_id to integer for security
    $staff_id = intval($_GET['staff_id']);
    //fetch vehicle list from the database
    // $staff_id = 12;
    $sql = "SELECT * FROM transactioninfor WHERE transaction_status = 'Pending..' && driver_id = " . $staff_id;
    $result = mysqli_query($conn, $sql);
    // query is a method call on the $conn object, where $sql is a string containing the SQL statement to be executed.
    // query method execute the sql queries againest a database. such as insert, select, delete, update
    // it also return the result for the select queries.
    // query does not support prepared paramters.
    if(!$result) {
        die('Error in SQL query: ' . mysqli_error());
    }
    // fetching assaigned jobs
    $assignedJobs = array();
    while($row = mysqli_fetch_assoc($result)){
        $assignedJobs[] = $row;
    }
    // Constructing output using implode function
    header('content-Type: text/plain');
    foreach($assignedJobs as $Transaction){
        echo implode(',', [$Transaction['TransactionID'], $Transaction['bookingID'], $Transaction['customer_name'], $Transaction['customer_phone'], 
        $Transaction['customer_email'], $Transaction['goods_type'], $Transaction['description'], $Transaction['pickup_location'], $Transaction['dropoff_location'],
        $Transaction['vehicleID'], $Transaction['vehicle_type'], $Transaction['vehicle_plate'], $Transaction['transaction_status']]). "\n";
        // the implode function is used to concatenat the values of good properties into a single string with each other separated by a comma. 
        // ',' is a string that serves as the delimiter to join array elements. 
    }
 } else{
     echo "No driver id";
 }
mysqli_close($conn)

?>