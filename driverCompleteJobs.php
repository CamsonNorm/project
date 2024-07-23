<?php
// Include connection file
include 'connection.php';

if (isset($_GET['staff_id'])) {
    // Convert staff_id to integer for security
    $staff_id = intval($_GET['staff_id']);

    // Fetch transactions from the database
    $sql = "SELECT * FROM transactioninfor WHERE transaction_status = 'Completed' AND driver_id = " . $staff_id;
    $result = $conn->query($sql);

    if (!$result) {
        die('Error in SQL query: ' . $conn->error);
    }

    // Fetching assigned jobs
    $assignedJobs = array();
    while ($row = $result->fetch_assoc()) {
        $assignedJobs[] = $row;
    }

    // Prepare plain text response
    header('Content-Type: text/plain');

    foreach ($assignedJobs as $transaction) {
        // Output each transaction data as comma-separated values on a new line
        echo implode(',', [
            $transaction['TransactionID'],
            $transaction['customer_name'],
            $transaction['customer_phone'],
            $transaction['goods_type'],
            $transaction['weight'],
            $transaction['description'],
            $transaction['pickup_location'],
            $transaction['dropoff_location'],
            $transaction['vehicle_type'],
            $transaction['vehicle_plate'],
            $transaction['driver_name'],
            $transaction['driverid_number'],
            $transaction['transaction_status']
        ]) . "\n";
    }
} else {
    echo "Error: Driver ID not provided.";
}

$conn->close();
?>

