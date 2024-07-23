<?php
// Include the database connection file 
include 'connection.php';
//include in php is a language construct used to include and evalutae the contents of another php file into the current script.
//if the specified file is not found, it generates a warning but continues to execute the script.
//include can be used to include the same file multiple times.
// require - is similar to include but if the file is missing, it stops from executing the script.
// if the file is crucial for the script to run properly, use 'require', but if the file is optional, use include.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
//$_SERVER - is a superglobal variable in PHP that holds information about server environment and the current request.
// it is an associative array that contain information such as headers, paths, and script locations.
//$_SERVER["REQUEST_METHOD"]-holds a request method that is used to access the page example, "GET", "POST", "PUT","DELETE"
// isset($_POST['username']) - is a function that checks if the username(parameter) has been sent to the server using method POST.
//$_POST - is an associative array for sending form data to the server.
    
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phone = $_POST['phone'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['cpassword'];
        if ($password !== $confirm_password) {
            echo "Error: Passwords do not match.";
            //terminate the script execution to stop further processing
            //exit() is a language construct in PHP.
            exit();
        }
        $password = password_hash($password, PASSWORD_DEFAULT);
        //to add the role of a customer in a defualt.
        $default_role = "Customer";
        //sql statement
        $data = "INSERT INTO user_table (first_name, last_name, phone, username, email, password, role) VALUES('$fname', '$lname', '$phone', '$username', '$email', '$password', '$default_role')";
        if ($conn->query($data) === TRUE) {
            //get_result(); is a method called on the prepared statement object('$data'). this method retrieves the result set produced  by executing the prepared statement.
            //$resultStaff is a varriable that holds the result.
            echo "Registration successffully";
            //exit() is a language construct in PHP.
            exit();
        } else {
            echo "Registration Failure: " . $conn->error;
            //error property of MYSQLI. it is used to retrieve the error message.
        }
        $conn->close();
    } else {
    echo "Invalid request";
}


