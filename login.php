<?php
session_start();
include_once 'connection.php';  
// Using include_once to avoid multiple inclusions
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Creating a statement to query customer table.
    $dataCustomer = "SELECT user_id, username, password, 'Customer' AS role FROM user_table WHERE username = '$username'";
    $resultCustomer = $conn->query($dataCustomer);

    // Creating statement to query staff table
    $dataStaff = "SELECT password, staffcategory AS role, staff_id, username FROM stafftable WHERE username = '$username'";
    $resultStaff = $conn->query($dataStaff);

    // Checking if user exists in the user_table
    if ($resultCustomer->num_rows == 1) {
        $row = $resultCustomer->fetch_assoc();
        $db_password = $row['password'];
        $role = $row['role'];
        $user_id = $row['user_id'];
    } elseif ($resultStaff->num_rows == 1) {
        // checking if user exists in stafftable
        $row = $resultStaff->fetch_assoc();
        $db_password = $row['password'];
        $role = $row['role'];
        $user_id = $row['staff_id'];
    } else {
        echo "Username not found. Please try again.";
        exit();
    }

    // Verify the password
    if (password_verify($password, $db_password)) {
        // Setting session variables
        $_SESSION['user_id'] = $user_id;
        $_SESSION['staff_id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        $_SESSION['staffcategory'] = $role;

        // Redirecting users based on role
        if ($role === 'Customer') {
            header("Location: book-transport.php");
        } elseif ($role === 'Admin') {
            header("Location: admin.html");
        } elseif ($role === 'Dispatcher' || $role === 'Driver') {
            header("Location: dispatcheranddriver.php");
        }
        exit();
    } else {
        echo "Incorrect password.";
    }

    // Close result sets if they exist
    if ($resultCustomer) $resultCustomer->close();
    if ($resultStaff) $resultStaff->close();
    
    $conn->close();  // Close the database connection
} else {
    echo "Invalid request.";
}
?>
