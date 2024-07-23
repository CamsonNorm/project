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
    // GET  - sends data in the URL visible to everyone, limited in data size, suitable for non-sensitive data
    // POST - sends data in the HTTP request body, not visible in the URL, can handle large amount of dat, suitable for sensitive information like password
    // isset($_POST['username']) - is a function that checks if the username(parameter) has been sent to the server using method POST.
    //$_POST - is an associative array for sending form data to the server.
  
//declare varibales to hold the values
$fullname = $_POST['customerfullname'];
$customerphone = $_POST['customer-phone'];
$address = $_POST['customer-address'];
$email = $_POST['customer-email'];
$goodstype = $_POST['goods-type'];
$quantity = $_POST['quantiy'];
$value = $_POST['volume'];
$wieght = $_POST['wieght'];
$pickuplocation = $_POST['pickup-location'];
$dropofflocation = $_POST['dropoff-location'];
$date = $_POST['delivery-date'];
$time = $_POST['delivery-time'];
$description = $_POST['description'];

  // sql query to insert data into database
  $sql = "INSERT INTO transactioninformation (fullname, phone, address, email, goodstype, quantity, volume, wieght, pickuplocation, dropofflocation , deliverydate, deliverytime, description ) VALUES 
    ('$fullname', '$customerphone', '$address', '$email', '$goodstype', '$quantity', '$value', '$wieght', '$pickuplocation', '$dropofflocation', '$date', '$time', '$description')";
  
      
  if($conn->query($sql) === TRUE){
    // query is a method call on the $conn object, where $sql is a string containing the SQL statement to be executed.
    // query method execute the sql queries againest a database. such as insert, select, delete, update
    // it also return the result for the select queries.
    // query does not support prepared paramters.
    //$_SESSION['success'] = true;
    //$_SESSION[] is a superglobal array used to store session variables
    //success is the key used to store the value in the session array. it represent the username of the current loged in user.
    // echo "Success";
    header("Location: book-transport.html");
    //header() is a php function or method used send raw HTTP headers like redirecting user
   //Location: - is the HTTP header being sent
    }else {
       echo "Failed".$conn->error;
  }
}
//close the connection
$conn->close();

    

