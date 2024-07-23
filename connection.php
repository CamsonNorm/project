<?php
// Database connection paramaters
$host = 'localhost';
$dbname = 'transport';
$db_username = 'Camson';
$db_password = 'camson@4980';
// Establish a Connection string
$conn = new mysqli($host, $db_username, $db_password, $dbname);
//$conn - is a varibale holding thhe connection
// $conn become an object of mysqli when it is instantiated
/// mysqli is a class in php that allows the interatction with the MySQLi 
// by using the new keyword we create an instance of a mysqli class which is basicaly an object.
// A class is a bluebrint that defines properties and method to interact whit MYSQLI
// An object is an instatance of a class MYSQLI. 
 if ($conn->connect_error) {
   //connect_error is a mysqli property that holds a string describing the last connection error. it is used to retrieve the error message when a connection fails.
   //$conn->connect-error - is a property that holds the last error meassage if the connection fails.
   // -> is an operator in php used to access the properties and methods in php.
    die("Connection failed: " . $conn->connect_error);
    //die() is a language constructor that terminates the execution of a script and display an error message.
    //when die is called, execution of script stops immediately and print a specified massage.
    //echo is not effective because it does not terminate the script like the die.
    // . is used to concatinate the string in php. 
 } 
 // Connection string in php is a string that specifies information about a data source parameters and the means of connecting to it