<?php
session_start();
include 'connection.php';
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['usernameForgot'];
    $role = $_POST['role'];
    $new_password = $_POST['newpassword'];
    $confirm_new_password = $_POST['confirmnewpassword'];
    if($new_password === $confirm_new_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        // To check if the user exist
        // Determining the correct table based on the role
        if($role === 'Customer') {
            $table = 'user_table';
            $idColumn = 'user_id';
        } elseif($role === 'Admin' || $role === 'Dispatcher' || $role === 'Driver') {
            $table = 'stafftable';
            $idColumn = 'staff_id';
        } else {
            echo 'Invalid role selected';
            exit;
        }
        $sql = $conn->prepare("SELECT $idColumn FROM $table WHERE username = ?");
        $sql->bind_param("s", $username);
        $sql->execute();  
        $result = $sql->get_result();
            
        if($result->num_rows > 0) {
            $sql->close();
            // To update the user password in database
            $sql = $conn->prepare("UPDATE $table SET password = ? WHERE username = ? ");
            $sql->bind_param("ss", $hashed_password, $username);
            if($sql->execute()) {
                echo "Password has been reset successffully";
            } else {
                echo "Error reseting password";
            }
                $sql->close();
            } else {
                echo "Username not found.";
            }
        // Closing database
        $conn->close();
    } else {
        echo "Password do not match!. Try again.";
    }
}
?>