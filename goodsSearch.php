<?php
// to include connection file
include 'connection.php';
//include in php is a language constuct used to include and evalutae the contents of another php file into the current script.
//if the specified file is not found, it generates a warning ut continues to execute the script.
//include can be used to include the same file multiple times.
// require - is similar to include but if the file is missing, it stops from executing the script.
// if the file is crucial for the script to run properly, use 'require', but if the file is optional, use include.
// if(isset($_POST['goods_option'])){
function getGoods($conn, $goodsType){
    $sql = "SELECT bookinginformation. *, user_table.* FROM bookinginformation INNER JOIN user_table ON bookinginformation.user_id = user_table.user_id WHERE bookinginformation.goodsType = '$goodsType'";
    $result = $conn->query($sql);
    if($result === FALSE){
        die("Error" .$conn->error);
    } else {
        // $goods =[];
        while($row = $result->fetch_assoc()){
            $goods[] = $row;
        }
        return $goods;
       //return $result->fetch_all(MYSQLI_ASSOC);
    }
}
$goodSelectedType = $_POST['goods_option'];
//$goodsType = 'fragile';
//$_POST['goods_option'];
$goods = [];
switch($goodSelectedType){
    case 'fragile':
      $goodsType = 'fragile';
      break;
    case 'perishable':
       $goodsType = 'perishable';
       break;
    case 'hazardous':
       $goodsType = 'hazardous';
       break;
    default:
    die("Invalid Type Selected");
}
$goods = getGoods($conn, $goodsType);

header('content-Type: text/plain');
foreach($goods as $good){
    echo implode(',', [$good['goodsType'], $good['description'], $good['wieght'], $good['pickupLocation'], 
    $good['dropoffLocation'], $good['bookingID'], $good['date'], $good['first_name'], $good['phone'], $good['email'], 
    $good['vehicleType'], $good['vehiclePlate']]). "\n";
    // the implode function is used to concatenat the values of good properties into a single string with each other separated by a comma. 
    // ',' is a string that serves as the delimiter to join array elements. 
}
$conn->close();


?>