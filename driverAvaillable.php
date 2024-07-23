<?php
//include connection files
include 'connection.php';
//include in php is a language constuct used to include and evalutae the contents of another php file into the current script.
//if the specified file is not found, it generates a warning ut continues to execute the script.
//include can be used to include the same file multiple times.
// require - is similar to include but if the file is missing, it stops from executing the script.
// if the file is crucial for the script to run properly, use 'require', but if the file is optional, use include.

//fetch vehicle list from the database
$sql = "SELECT staff_id, first_name, last_name, phone, email, idnumber FROM stafftable WHERE staffcategory = 'Driver' ";
$result = $conn->query($sql);
// query is a method call on the $conn object, where $sql is a string containing the SQL statement to be executed.
// query method execute the sql queries againest a database. such as insert, select, delete, update
// it also return the result for the select queries.
// query does not support prepared paramters.

//initialize empty array
$driverlist = array();
if($result->num_rows > 0){
    while($row = $result -> fetch_assoc()){//associative array
         //fetch_assoc(); is a method called on thge result set. it retrieves the next row from the result set and returns it as an associative array.
         //$row is a variable holding the associative array data.
         // -> is an object operator.
        $driverlist[] = $row;
    }
}
header('content-Type: text/plain');
foreach($driverlist as $Transaction){
    echo implode(',', [$Transaction['staff_id'], $Transaction['first_name'], $Transaction['phone'], $Transaction['email'], 
    $Transaction['idnumber']]). "\n";
    // the implode function is used to concatenat the values of good properties into a single string with each other separated by a comma. 
    // ',' is a string that serves as the delimiter to join array elements. 
}

$conn->close();

?>