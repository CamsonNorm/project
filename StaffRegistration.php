<?php
// Include the database connection file
include 'connection.php';
//include in php is a language constuct used to include and evalutae the contents of another php file into the current script.
//if the specified file is not found, it generates a warning ut continues to execute the script.
//include can be used to include the same file multiple times.
// require - is similar to include but if the file is missing, it stops from executing the script.
// if the file is crucial for the script to run properly, use 'require', but if the file is optional, use include.

// Handle form submission if the connection is established
if($_SERVER["REQUEST_METHOD"] == "POST"){
  //$_SERVER - is a superglobal variable in PHP that holds information about server environment and the current request.
  // it is an associative array that contain information such as headers, paths, and script locations.
  //$_SERVER["REQUEST_METHOD"]-holds a request method that is used to access the page example, "GET", "POST", "PUT","DELETE"
  $role = $_POST["role"];
  $fname = $_POST["staff_fname"];
  $lname = $_POST["staff_lname"];
  $username = $_POST["staff_username"];
  $email = $_POST["staff_email"];
  $phone = $_POST["staff_phone"];
  $address = $_POST["staff_address"];
  $idnumber = $_POST["id_number"];
  $password = $_POST["staff_password"];
  // check if password is correct
  $confirm_password = $_POST["staff_cpassword"];
  if($password != $confirm_password){
    echo "Password does not match";
    exit();
  }
  // Hash the password after confirmation
  $password = password_hash($password, PASSWORD_DEFAULT); 

  //construct an sql query to insert data into database table stafftable
  $sql = "INSERT INTO stafftable (staffcategory, first_name, last_name, username, email, phone, addres, idnumber, password) VALUES 
  ('$role', '$fname', '$lname', '$username', '$email', '$phone', '$address', '$idnumber', '$password')";
    // makes a query and check if the execution query was successful
    // condition statement used to check if a dtabase query was executed succesfully.
  if($conn->query($sql) === TRUE){
    // query is a method call on the $conn object, where $sql is a string containing the SQL statement to be executed.
    // query method execute the sql queries againest a database. such as insert, select, delete, update
    // it also return the result for the select queries.
    // query does not support prepared paramters.
    echo "Registration successffully";
    }else {
      echo "Registration Failure: " . $conn->error;
      //error property of MYSQLI. it is used to retrieve the error message.
  }
} else {
  echo "Invalid request";
}