<?php
include 'connection.php';
function getVehiclesbooked($conn, $vehicle_type ) {
    $sql = "SELECT * FROM bookinginformation WHERE vehicleType = '$vehicle_type'";
    $result = $conn->query($sql);
    if($result === FALSE){
        die("Erro" .$conn->error);
    } 
   // $vehicles = $result->fetch_all(MYSQLI_ASSOC);
    return $result->fetch_all(MYSQLI_ASSOC);;
}

$vehicle_by_type = $_POST['vehicleType'];
//$vehicle_type = 'Big-Truck';
$vehicles = [];

switch($vehicle_by_type) {
    case 'lory':
        $vehicle_type = 'Lory';
        break;
    case 'big_Truck':
        $vehicle_type = 'Big-Truck';
        break;
    case 'pickup':
        $vehicle_type = 'PickUp';
        
        break;
    default:
    die("Invalid Type selected");
}
$vehicles = getVehiclesbooked($conn, $vehicle_type);
header('content-Type: text/plain');
foreach($vehicles as $vehicle){
    echo implode(',', [$vehicle['vehicleType'], $vehicle['vehiclePlate'], $vehicle['vehiclleCapacity'], $vehicle['vehicleStatus']]). "\n";
    // the implode function is used to concatenat the values of good properties into a single string with each other separated by a comma. 
    // ',' is a string that serves as the delimiter to join array elements. 
}
//close the connection
$conn->close();



?>

