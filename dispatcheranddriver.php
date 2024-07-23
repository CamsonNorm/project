<?php
session_start();
//checking if user is logged in in and their role
if(isset($_SESSION['staffcategory'])) {
    $role = $_SESSION['staffcategory'];
    // $_SESSION[] is a php associative array variable used to store session information about a user
    $welcome = ucfirst($role); //welcome message
    // ucfirst() ia a function in php used to capitalize the first charatcter of a string

} else {
    // redirect to loggin
    header('Location: index.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dispatcher and driver page</title>
    <link rel="stylesheet" href="dispatcherDriver.css">
    <script src="dispatcherDriver.js"></script>
</head>
<body>   

<?php if($role === 'Dispatcher'): ?>
<div id="Dispatcher">
    <div class="Dispatcher_section">
 
        <h2><?php echo "Welcome  ", $welcome; ?></h2>
<div>
    
</div>
        <div class="user-control" id="user-control">
            <!-- to see new bookings -->
            <a href="#" onclick="displayDispatcherSection()">Newbookings</a>
            <!-- to see the assigned driver transaction -->
            <a href="#" onclick="assignedDriverTransaction()">Assigned Transaction</a></li>
            <!-- to see reports -->
            <a href="#" onclick="toEnablelinktoshowCompletedTransportsPage()">Completed Transports</a></li>
            <a href="logout.php">LOGOUT</a>
        </div>


        <div class="dispatcher_section" id="dispatcher_section">
        
            <p>Dispatcher section</p>
            <!-- page to display the bookings send by the admin to the dispatcher page -->
            <div class="new_bookings_page" id="transactionData">
               
            </div>
        </div>

        <!-- page to show assigned driver transaction -->
        <div class="assignedDriverTransaction" id="assignedDriverTransaction">
            <h1>Assigned Jobs to driver</h1>
            <table id="assignedTodriverBookings" class="assignedTodriverBookings">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Customer name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Goods Type</th>
                        <th>Weight</th>
                        <th>Vehicle Type</th>
                        <th>Plate</th>
                        <th>Driver ID</th>
                        <th>Driver Name</th>
                        <th>Driver Phone</th>
                        <th>Driver Email</th>
                        <th>Driver ID number</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="assignedTodriverBookingsTable"  class="assignedTodriverBookingsTable" > 
                   <!-- assigned to driver list will be displayed on this section -->
                </tbody>
               </table>
        </div>
        
    </div>

    <div class="assigningDriverPage"  id="assigningDriverPage">
       
        <h1>Assigning A Driver</h1>
        <h2>Details</h2>
        <div class="infor">
            <div class="inforData1">
                <p id="booking_id"></p>
                <p id="name"></p>
                <p id="phone_number"></p>
                <p id="Customer_email"></p>
                <p id="pickLocation"></p>
                <p id="dropLocation"></p>
            </div>
            <div class="inforData2">
                <p id="vehicle_id"></p>
                <p id="VehilceType"></p>
                <p id="PlateNumber"></p>
                <p id="goods_Type"></p>
                <p id="goodsWeight"></p>
                <p id="goodsDescription"></p>
            </div>
            <button type="button" id="choseAdriver" onclick="displaDriverList()">chose a Driver</button>
        </div>
        
        
    </div>
    <div class="assigDriverList" id="assigDriverList" >
        <h1>Availlable Drivers</h1>
        <div id="driversAvaillablelist" class="driversAvaillablelist" style="display: block;">
            <table id="driversAvaillable">
             <thead>
                 <tr>
                    <th>Staff ID</th>
                     <th>First Name</th>
                     <th>Lats Name</th>
                     <th>email</th>
                     <th>phone</th>
                     <th>Id Number</th>
                     <th>Choose</th>
                     
                 </tr>
             </thead>
             <tbody id="driversAvaillableTable"  class="driversAvaillableTable" > 
                <!-- driver list will be displayed on this section -->
             </tbody>
            </table>
         </div>
    </div>

    <div class="completedTransport" id="completedTransport">
        <h1>COMPLETED TRANSPORTS</h1>
        <div>
        <table id="completedTransporst" class="completedTransporst">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Customer Name</th>
                        <th>Customer Phone</th>
                        <th>Goods Type</th>
                        <th>Weight</th>
                        <th>Vehicle Type</th>
                        <th>Plate</th>
                        <th>Driver ID</th>
                        <th>Driver Name</th>
                        <th>Driver Phone</th>
                        <th>Payment Method</th>
                        <th>Payment Number</th>
                        <th>Payment Code</th>
                        <th>Amount Paid</th>
                        <th>Payment Status</th>
                    </tr>
                </thead>
                <tbody id="completedTransporstTable"  class="completedTransporstTable" > 
                   <!-- completed Transports list will be displayed on this section -->
                </tbody>
               </table>
        </div>

    </div>

</div>
<?php elseif($role === 'Driver'): ?>
        <div class="welcomedriverID">
            <?php
             if(isset($_SESSION['staff_id'])) {
             // this line check if the usernme index is set in the $_SESSION superglobal array. the isset() fucntion 
             //is used to determine if a variable is declared and is different than null
             echo '<p id="driverID">' .$_SESSION['staff_id'] . '</p>';
            } else {
              echo '<p>Missing ID!</p>';
            }
           ?>
        </div>
        <div class="driverAssignedJobs">         
            <h1>DRIVER PAGE</h1>
            <div class="driver_access_links">
            <ul>
                <a href="#" id="openJobsforDriver">My New Jobs</a>
            </ul>
            <ul>
                <a href="#" id="openDriverCompletedJobs">Complete Jobs</a>
            </ul>
            <ul>
                <a id="driverLogout" href="logout.php" >Logg Out</a>
            </ul>
            </div>
            
            
            <!-- <p id="Element"></p> -->
            <div class="jobsSection" id="jobsSection" >
            <h1>My Assigned Jobs</h1>
                <table id="JobsTable">
                    
                    <thead>
                        <tr>
                            <th>Job ID</th>
                            <th>Booking ID</th>
                            <th>Customer Name</th>
                            <th>Customer Phone</th>
                            <th>Customer Email</th>
                            <th>Goods Type</th>
                            <th>Description</th>
                            <th>Pickup Location</th>
                            <th>Dropoff Location</th>
                            <th>Vehicle ID</th>
                            <th>Vehicle Type</th>
                            <th>Plate Number</th>
                            <th>Status</th>
                            <th>Complete Transaction</th>
                        </tr>
                    </thead>
                     <tbody id="driverJobsTable"  class="driverJobsTable" > 
                         <!-- driver jobs list be displayed on this section -->
                     </tbody>
                </table>
                <div class="complete_Transaction_page" id="complete_Transaction_page">
                <div class="complete_Transaction">
                    <p>To Complete Transaction Enter Details Below:</p>
                    <form action="completeTransactionByDriver.php" id="complete_transaction_form" class="complete_transaction_form" method="POST">
                           <input type="hidden" id="transac_id" name="staff_id">
                           <input type="hidden" id="vehicleID_update" name="vehicleID_update">
                           <label for="paymnetMethod">Select Payment Method</lable>
                            <select name="paymnetMethod" id="paymnetMethod">
                                <option value="M-PESA">M-PESA</option>
                                <option value="EQUITY">EQUITY</option>
                                <option value="KCB">KCB</option>
                            </select>
                            <label for="Payment Number">Enter Payment Number</label>
                            <input type="text" name="payment_number" id="payment_number"  required>
                            <label for="Payment Number">Enter Payment Code</label>
                            <input type="text" name="payment_code" id="payment_code" required>
                            <label for="Payment Number">Enter Time Taken (Hours)</label>
                            <input type="text" name="time_taken" id="time_taken"  required>
                            <label for="Payment Number">Enter Amount Paid</label>
                            <input type="text" name="amount_paid" id="amount_paid" required>

                            <button type="submit" id="complete_Transaction_button" onclick="tocompleteTransaction(event)">Complete</button>
                    </form>
                    <div id="complete_Transaction_message_container">
                        <p id="complete_Transaction_message_text"></P>
                    </div>
                    
                </div>
            </div>
            


        </div>
    </div>
<div class="completedDriverJobs" id="completedDriverJobs">
    <h2>My Completed Jobs</h2>
    <!-- <p id="idd"></p> -->
    <table id="driverCompleteJobs" class="driverCompleteJobs">
        <thead>
            <tr>
                <th>Job ID</th>
                <th>Customer Name</th>
                <th>Customer Phone</th>
                <th>Goods Type</th>
                <th>Weight</th>
                <th>Description</th>
                <th>Pickup Location</th>
                <th>Dropoff Location</th>
                <th>Vehicle Type</th>
                <th>Plate</th>
                <th>Driver Name</th>
                <th>Driver Phone</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="driverCompleteJobsTable"  class="driverCompleteJobsTable" > 
             <!-- completed Transports list will be displayed on this section -->
    </tbody>
</table>
</div>
<?php endif;?>
<script>
document.getElementById('openDriverCompletedJobs').addEventListener('click', function() {
    document.getElementById("completedDriverJobs").style.display = "block";
    document.getElementById("jobsSection").style.display = "none";
    
});
document.getElementById('openJobsforDriver').addEventListener('click', function() {
    document.getElementById("completedDriverJobs").style.display = "none";
    document.getElementById("jobsSection").style.display = "block";
});
document.addEventListener("DOMContentLoaded", function(){
    var driverElement = document.getElementById('driverID').textContent;
    const xhr = new XMLHttpRequest();
    // Opening the GET request with the encoded driver element as a query parameter
    xhr.open('GET',  'fechJobsToDriver.php?staff_id=' + encodeURIComponent(driverElement), true);
    
    // Define what happens on successful data submission
    xhr.onload = function() {
        if (xhr.status == 200) {
            var jobs = xhr.responseText;
            // Call the AssignedJobs function with the retrieved jobs data
            AssignedJobs(jobs);
        } else {
            alert('Error fetching assigned jobs: ' + xhr.statusText);
        }
    };
    xhr.send();
    function AssignedJobs(jobs) {
        var rows = jobs.split('\n');
         // Split the data into rows
        var tableBody = document.getElementById('driverJobsTable');
        rows.forEach(function(row) {
            if (row.trim() !== '') { 
                // Check if the row is not empty
                var cols = row.split(',');
                 // Split the row into columns
                var tr = document.createElement('tr');
                 // Create a new table row element
    
                // Iterate over each column and create table data cells
                cols.forEach(function(col) {
                    var td = document.createElement('td');
                     // Create a new table data cell element
                    td.textContent = col;
                    // Setting the text content of the cell
                    tr.appendChild(td); 
                    // Appending the cell to the row
                });
    
                // Add a cell for the 'Complete Transaction' button
                var tdButton = document.createElement('td');
                var button = document.createElement('button');
                button.setAttribute('id', 'jodsCompleteButton');
                button.textContent = 'Complete';
                 // Add an event listener to the button to alert Job ID and Vehicle ID
                 button.addEventListener('click', function() {
                    // Accessing the TransactionId to be used to update transaction
                    var TransactionId = cols[0]; 
                    document.getElementById('transac_id').value = TransactionId;
                    // Accessing vehicleID to be used in updating vehicle table. 
                    var vehicleID = cols[9];
                    document.getElementById('vehicleID_update').value = vehicleID;
                    
                    //alert('Job ID: ' + TransactionId + '\nVehicle ID: ' + vehicleID);
                    document.getElementById("complete_Transaction_page").style.display = "block";
                });
                
    
                tdButton.appendChild(button);
                tr.appendChild(tdButton);
    
                // Append the row to the table body
                tableBody.appendChild(tr);
            }
        });
        
    }
});
document.addEventListener("DOMContentLoaded", function() {
    var driverElement = document.getElementById('driverID');
    var driverId = driverElement.textContent.trim();
    // document.getElementById('idd').textContent = driverId;

    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'driverCompleteJobs.php?staff_id=' + encodeURIComponent(driverId), true);
    xhr.onload = function() {
        if (xhr.status == 200) {
            var completedJobs = xhr.responseText;
            driverCompletTask(completedJobs);
        } else {
            alert('Error fetching Complete jobs: ' + xhr.statusText);
        }
    };
    xhr.send();

    function driverCompletTask(completedJobs) {
        const tableBody = document.getElementById('driverCompleteJobsTable');
        tableBody.innerHTML = '';

        if (completedJobs.trim().length > 0) {
            let rows = completedJobs.trim().split('\n');
            rows.forEach(row => {
                let columns = row.split(',');
                let tr = document.createElement('tr');
                columns.forEach(column => {
                    let td = document.createElement('td');
                    td.textContent = column.trim(); // Trim whitespace from each column
                    tr.appendChild(td);
                });
                tableBody.appendChild(tr);
            });
        } else {
            // If no transactions found, display a message in a single cell spanning all columns
            let tr = document.createElement('tr');
            let td = document.createElement('td');
            td.colSpan = 3; // Adjust this number based on the number of columns in your table
            td.textContent = "No information found";
            tr.appendChild(td);
            tableBody.appendChild(tr);
        }
    }
});

</script>
</body>
</html>
