<?php
// Include the connection string
include 'connection.php';
//include in php is a language constuct used to include and evalutae the contents of another php file into the current script.
//if the specified file is not found, it generates a warning ut continues to execute the script.
//include can be used to include the same file multiple times.
// require - is similar to include but if the file is missing, it stops from executing the script.
// if the file is crucial for the script to run properly, use 'require', but if the file is optional, use include.

// Fetch staff from the table based on role
// Get the role from the URL parameter
$staffcategory = $_GET['staffcategory'];
//$_GET['sfaffcategory'] - this retrieve the value of the parameter sftaffcategory from the database
//$_GET is a superglobal array in php that is used to collect data

// Define the SQL query
$sql = "SELECT first_name, last_name, username, email, phone, staffcategory FROM stafftable WHERE staffcategory = ?";
$data = $conn->prepare($sql);
//$conn->prepare() is a method used to prepare an SQL statement for execution. it is used to help stop SQL injection
 //prepare is a method of the MYSQLI class used to prepare an SQL statement.
$data->bind_param("s", $staffcategory);
//bind-param() is a method used to bind paramaters to a prepared statement before executing it. . 
//it safely insert data into sql query, preventing SQL injction attacks.
//bind the values to the placeholders
$data->execute();
//execute(); is a method used to execute a prepared statement with any bound paramters
// it is sued in the context of the prepared staments, where you first prepare an sql statement and then execute it with bound parameters.
$result = $data->get_result();
//get_result(); is a method called on the prepared statement object('$dataCustomer'). this method retrieves the result set produced  by executing the prepared statement.
//$resultStaff is a varriable that holds the result.


// initilaize an empty string with a variable $staffs
//array() is a constructor function in php used to create array
$staffs = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { // Corrected variable name here
        //fetch_assoc(); is a method called on the result set. it retrieves the next row from the result set and returns it as an associative array.
        //$row is a variable holding the associative array data.
        $staffs[] = $row;
        //$staffs[] is used to access the next available indext in the array $staffs
        // $row variable representing the data retrieved
    }
}

// Return user data as JSON
// header() is a php function used to send a raw HTTP header to the client
foreach($staffs as $staff){
    echo implode(',', [$staff['first_name'], $staff['last_name'], $staff['username'], $staff['email'], $staff['phone'], 
    $staff['staffcategory']]). "\n";
    // the implode function is used to concatenat or join the values of staff properties into a single string with each other separated by a comma. 
    // ',' is a string that serves as the delimiter to join array elements. 
}
$data->close();
$conn->close();
?>
