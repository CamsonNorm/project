<?php
include 'connection.php';
function getBookings($conn, $startdate, $enddate){
    $sql = "SELECT bookinginformation.*, user_table.* FROM bookinginformation JOIN user_table ON bookinginformation.user_id = user_table.user_id WHERE bookinginformation.date BETWEEN '$startdate' AND '$enddate' ";
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

$timeRange = $_POST['timeRange'];
$bookings =[];

// $startdate = '2024-05-03';
// $enddate = '2024-05-27' ;

switch($timeRange) {
    case 'today':
        $startdate = $enddate = date('Y-m-d');
        break;
    case 'this_week':
        $startdate = date('Y-m-d', strtotime('monday this week'));
        $enddate = date('Y-m-d', strtotime('sunday this week'));
        // strtotime() is a function that parses an english textual datetime description into a Unix timestamp
        break;
    case 'last_week':
        $startdate = date('Y-m-d', strtotime('monday last week'));
        $enddate = date('Y-m-d', strtotime('sunday last week'));
        break;
    case 'this_month':
        $startdate = date('Y-m-01');
        $enddate = date('Y-m-t');
        break;
    case 'last_month':
        $startdate = date('Y-m-01', strtotime('firts day of last month'));
        $enddate = date('Y-m-t', strtotime('last day of last month'));
        break;
    case 'this_year':
         $startdate = date('Y-0-01');
        $enddate = date('Y-12-31');
        break;
    default:
    die("Invalid time range selected");
}
$bookings = getBookings($conn, $startdate, $enddate);
header('content-Type: text/plain');
foreach($bookings as $booking){
    echo implode(',', [$booking['bookingID'], $booking['date'], $booking['first_name'], $booking['phone'], $booking['email'], 
    $booking['goodsType'], $booking['description'], $booking['wieght'], $booking['pickupLocation'], $booking['dropoffLocation'],
    $booking['vehicleType'], $booking['vehiclePlate']]). "\n";
    // the implode function is used to concatenat or join the values of booking properties into a single string with each other separated by a comma. 
    // ',' is a string that serves as the delimiter to join array elements. 
}
$conn->close();

?>

