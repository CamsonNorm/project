<?php
// include the connection string
include 'connection.php';
//include in php is a language constuct used to include and evalutae the contents of another php file into the current script.
//if the specified file is not found, it generates a warning ut continues to execute the script.
//include can be used to include the same file multiple times.
// require - is similar to include but if the file is missing, it stops from executing the script.
// if the file is crucial for the script to run properly, use 'require', but if the file is optional, use include.

//Fetch customer users from database
$sql = "SELECT first_name, last_name, username, email, phone FROM user_table";
$result = $conn->query($sql);
//  query is a method call on the $conn object, where $sql is a string containing the SQL statement to be executed.
// query method execute the sql queries againest a database. such as insert, select, delete, update
// it also return the result for the select queries.
// query does not support prepared paramters.

//initializing an empty array
//array() is a constructor function in php used to create array
$customers = array();
if($result->num_rows > 0) {
    while($row = $result -> fetch_assoc()) {
        //fetch_assoc(); is a method called on the result set. it retrieves the next row from the result set and returns it as an associative array.
        //$row is a variable holding the associative array data.
        $customers[] = $row;
    }
}
header('content-Type: text/plain');
foreach($customers as $customer){
    echo implode(',', [$customer['first_name'], $customer['last_name'], $customer['username'], $customer['email'], $customer['phone']]). "\n";
    // the implode function is used to concatenat or join the values of booking properties into a single string with each other separated by a comma. 
    // ',' is a string that serves as the delimiter to join array elements. 
}

// close the connection
$conn->close();
?>