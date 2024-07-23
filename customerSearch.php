<?php
include 'connection.php';
function getBookings($conn, $phone ){
    $sql = "SELECT bookinginformation. *, user_table.* FROM bookinginformation INNER JOIN user_table ON bookinginformation.user_id = user_table.user_id WHERE user_table.phone = '$phone'";
    $result = $conn->query($sql);
    if($result === FALSE){
        die("Erro". $conn->error);
    }
    return $result->fetch_all(MYSQLI_ASSOC);
    // $bookings =[];
    // while($row = $result->fetch_assoc()){
    //     $bookings[] = $row;
    // }
    // return $bookings;
}
$phone = $_POST['phonenumber'];
//'734789824';
//$_POST['goods_option'];
$customers =[];
$customers = getBookings($conn, $phone);

header('content-Type: text/plain');
foreach($customers as $customer){
    echo implode(',', [$customer['user_id'], $customer['first_name'], $customer['phone'], $customer['email'], 
    $customer['bookingID'], $customer['goodsType'], $customer['pickupLocation'], $customer['dropoffLocation']]). "\n";
    // the implode function is used to concatenat the values of good properties into a single string with each other separated by a comma. 
    // ',' is a string that serves as the delimiter to join array elements. 
}
$conn->close();
?>