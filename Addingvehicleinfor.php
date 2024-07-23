<?php
// Include the database connection file 
include 'connection.php';
//include in php is a language construct used to include and evalutae the contents of another php file into the current script.
//if the specified file is not found, it generates a warning but continues to execute the script.
//include can be used to include the same file multiple times.
// require - is similar to include but if the file is missing, it stops from executing the script.
// if the file is crucial for the script to run properly, use 'require', but if the file is optional, use include.

//Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['Add'])){
//$_SERVER - is a superglobal variable in PHP that holds information about server environment and the current request.
// it is an associative array that contain information such as headers, paths, and script locations.
//$_SERVER["REQUEST_METHOD"]-holds a request method that is used to access the page example, "GET", "POST", "PUT","DELETE"
// GET  - sends data in the URL visible to everyone, limited in data size, suitable for non-sensitive data
// POST - sends data in the HTTP request body, not visible in the URL, can handle large amount of data, suitable for sensitive information like password
// isset($_POST['Add']) - is a function that checks if the add(parameter) has been sent to the server using method POST.
//$_POST - is an associative array for sending form data to the server.
// Create variables to hold vehicle details
$vehicletype = $_POST['vehicle-type'];
$plateno = $_POST['plate-no'];
$model = $_POST['model'];
$make = $_POST['make'];
$capacity = $_POST['capacity'];
$insurance = $_POST['insurance'];
$fueltype = $_POST['fuel-type'];
$status = 'Available';

//Insert data to the database
$sql = "INSERT INTO vehicle (vehicleType, plateNumer, vehiclemodel, vehiclemake, vehiclecapacity, vehicleInsuranceNO, fuelType, vehicle_status) VALUES('$vehicletype', '$plateno', '$model', '$make', '$capacity', '$insurance', '$fueltype', '$status')";
if($conn->query($sql) == TRUE){
//  query is a method call on the $conn object, where $sql is a string containing the SQL statement to be executed.
// query method execute the sql queries againest a database. such as insert, select, delete, update
// it also return the result for the select queries.
// query does not support prepared paramters.
echo 'vehicle updated successfulyy';
exit;
//terminate the script execution to stop further processing
//exit() is a language construct in PHP.           
} else {
    echo "Error: " .$conn->error;
 }
} 
// close the connection
$conn->close();
?>


