//function to display dispatcher section
function displayDispatcherSection(){
    document.getElementById("dispatcher_section").style.display = "block";
    document.getElementById("assignedDriverTransaction").style.display = "none";
    document.getElementById("completedTransport").style.display = "none";
}

function fetchBookings() {
    fetch('fectCustomerTransactionInfor.php')
        .then(response => response.text())
        .then(data => {
            // Split the data into lines
            const bookings = data.trim().split('\n');
            
            // Create a container div
            const container = document.getElementById('transactionData');
            
            // Clear any existing content
            container.innerHTML = '';

            // Iterate over each booking and create p elements
            for (let booking of bookings) {
                // Split each booking into fields
                const fields = booking.split(',');
                const Customer_data = document.createElement('div');
                Customer_data.setAttribute('class', 'dataIndex');
                const hr = document.createElement('hr');

                
                // Create a p element for customer information
                const customer_data = document.createElement('div');
                customer_data.setAttribute('class', 'customer_data')

                // customer infor
                const customer_infor = document.createElement('div');
                customer_infor.setAttribute('class', 'customer_infor');
                const h1 = document.createElement('h1');
                h1.textContent = "customer data";
                const transac_id = document.createElement('p');
                transac_id.setAttribute('id', 'transac_id');
                transac_id.textContent = `Transact ID: ${fields[0]}`;
                const name = document.createElement('p');
                name.setAttribute('id', 'cellname');
                name.textContent = `Name: ${fields[1]}`;
                const email = document.createElement('p');
                email.setAttribute('id', 'cellemail');
                email.textContent = `Email: ${fields[2]}`;
                const Phone = document.createElement('p');
                Phone.setAttribute('id', 'cellphone');
                Phone.textContent = `Phone: ${fields[3]}`;
                customer_infor.appendChild(h1);
                customer_infor.appendChild(transac_id);
                customer_infor.appendChild(name);
                customer_infor.appendChild(email);
                customer_infor.appendChild(Phone);

                // goods information
                const goods_Data = document.createElement('div');
                goods_Data.setAttribute('class', 'goods_Data');
                const h2 = document.createElement('h1');
                h2.textContent = "Goods data";
                const goodstype = document.createElement('p');
                goodstype.setAttribute('id', 'goodsType')
                goodstype.textContent = `Goods Type: ${fields[4]}`;
                const Weight = document.createElement('p');
                Weight.setAttribute('id', 'Weight')
                Weight.textContent = `Weight: ${fields[5]}`;
                const description = document.createElement('p');
                description.setAttribute('id', 'description')
                description.textContent = `Description: ${fields[6]}`;

                const pickuLocation = document.createElement('p');
                pickuLocation.setAttribute('id', 'pickuLocation')
                pickuLocation.textContent = `Pickup Location: ${fields[7]}`;

                const dropoffLocation = document.createElement('p');
                dropoffLocation.setAttribute('id', 'dropoffLocation')
                dropoffLocation.textContent = `Drop off Location: ${fields[8]}`;
                goods_Data.appendChild(h2);
                goods_Data.appendChild(goodstype);
                goods_Data.appendChild(Weight);
                goods_Data.appendChild(description);
                goods_Data.appendChild(pickuLocation);
                goods_Data.appendChild(dropoffLocation);

                //vehicle information
                const vehicle_data = document.createElement('div');
                vehicle_data.setAttribute('class', 'vehicle_Data');
                const h3 = document.createElement('h1');
                h3.textContent = "Vehicle data";
                const vehicleID = document.createElement('p');
                vehicleID.textContent = `vehicle ID: ${fields[9]}`;
                vehicleID.setAttribute('id', 'vehicle_ID')
                const vehicletype = document.createElement('p');
                vehicletype.setAttribute('id', 'vehicletype')
                vehicletype.textContent = `Vehicle Type: ${fields[10]}`;
                const plate = document.createElement('p');
                plate.setAttribute('id', 'vehicle_plate');
                plate.textContent = `plate: ${fields[11]}`;
                const capacity = document.createElement('p');
                vehicle_data.appendChild(h3);
                vehicle_data.appendChild(vehicleID);
                vehicle_data.appendChild(vehicletype);
                vehicle_data.appendChild(plate);
               
                
                const assingButton = document.createElement('button');
                assingButton.setAttribute('id', 'assingButton');
                assingButton.textContent = "Assign Driver";
                
                assingButton.addEventListener('click', function(){
                    var customerFormData = {
                         //goods information
                         transac_id: document.getElementById("transac_id").textContent,
                         name: document.getElementById("cellname").textContent,
                         email: document.getElementById("cellemail").textContent,
                         phone: document.getElementById("cellphone").textContent,
                          goodsType: document.getElementById("goodsType").textContent,
                          Weight: document.getElementById("Weight").textContent,
                         description: document.getElementById("description").textContent,
                       
                        //  //vehicle information
                          pickuLocation: document.getElementById("pickuLocation").textContent,
                         dropoffLocation: document.getElementById("dropoffLocation").textContent,
                        plate: document.getElementById("vehicle_plate").textContent,
                         vehicletype: document.getElementById("vehicletype").textContent,
                         vehicleID: document.getElementById("vehicle_ID").textContent,
                    };
                   document.getElementById('booking_id').textContent = customerFormData.transac_id;
                   document.getElementById('name').textContent = customerFormData.name;
                   document.getElementById('phone_number').textContent = customerFormData.phone;
                    document.getElementById('Customer_email').textContent = customerFormData.email;
                    document.getElementById('pickLocation').textContent = customerFormData.pickuLocation;
                    document.getElementById('dropLocation').textContent = customerFormData.dropoffLocation;
                   document.getElementById('vehicle_id').textContent = customerFormData.vehicleID;
                    document.getElementById('VehilceType').textContent = customerFormData.vehicletype;
                    document.getElementById('PlateNumber').textContent = customerFormData.plate;
                   document.getElementById('goods_Type').textContent = customerFormData.goodsType;
                   document.getElementById('goodsWeight').textContent = customerFormData.Weight;
                    document.getElementById('goodsDescription').textContent = customerFormData.description;

                    showDriverPage();
                });

                // Appand the divs
                container.appendChild(Customer_data);
                Customer_data.appendChild(customer_infor);
                Customer_data.appendChild(goods_Data);
                Customer_data.appendChild(vehicle_data);
                Customer_data.appendChild(assingButton);
                //Customer_data.appendChild(assingButton);
                Customer_data.appendChild(hr);
            }
        })
        .catch(error => console.error('Error fetching bookings:', error));
}

// Fetch bookings when the page loads
window.onload = fetchBookings;
   
      
// function to display assign driver page
function showDriverPage(){
    document.getElementById("assigningDriverPage").style.display = "block";
    //displayCustomerInformationOnAssignDriverPage(data);
}

//to display the customer information on the assign driver page
function displayCustomerInformationOnAssignDriverPage(data){
  
    //to display
    document.getElementById("booking_id").innerText ="BookingID: " + " " + data.bookingID;
    document.getElementById("name").innerText ="Name: " + " " + data.customer_name;
    document.getElementById("phone_number").innerText = "Phone: " + " " + data.customer_phone;
    document.getElementById("Customer_email").innerText = "Email: " + " " + data.customer_email;
    document.getElementById("pickLocation").innerText = "Pickup Location: " + " " + data.pickup_location;
    document.getElementById("dropLocation").innerText = "Dropoff Location: " + " " + data.dropoff_location;
    document.getElementById("vehicle_id").innerText = "Vehicle ID: " + " " + data.vehicleID;
    document.getElementById("VehilceType").innerText = "Vehicle Type: " + " " + data.vehicle_type;
    document.getElementById("PlateNumber").innerText = "Plate Number: " + " " + data.vehicle_plate;
    document.getElementById("goods_Type").innerText = "Goods Type: " + " " + data.goods_type;
    document.getElementById("goodsWeight").innerText = "Wieght: " + " " + data.weight;
    document.getElementById("goodsDescription").innerText = "Description: " + " " + data.description;
}
// to add an event listener to ButtonToAssigning butoon
document.getElementById("choseAdriver").addEventListener('click', function() {
    displaDriverList();
    
});

function displaDriverList(){
    document.getElementById("assigDriverList").style.display = 'block';
    displaydriverlistavailable();
}


function displaydriverlistavailable(){
    //fetch vehilces form the database using a server
    fetch('driverAvaillable.php')
    .then(response => response.text())
            // this second then() callback fucntion recieve the parsed data as its argument for processing it.
            .then(data => {
                const tBody = document.getElementById('driversAvaillableTable');
                tBody.innerHTML = '';
                const drivers = data.split('\n');
                drivers.forEach(driver => {
                    const fields = driver.split(',');
                    const row = document.createElement('tr');
        
                    fields.forEach(field => {
                        const cell = document.createElement('td');
                        cell.textContent = field;
                        row.appendChild(cell);
                    });
        
                    const actionButton = document.createElement('td');
                    const bookButton = document.createElement('button');
                    bookButton.innerHTML = "select"; 
                    bookButton.addEventListener('click', function() {
                        const driverID = fields[0];
                        const driverName = fields[1];
                        const email = fields[3];
                        const phone = fields[2];
                        const idnumber = fields[4];
                        const bookingID = document.getElementById('booking_id').textContent.split(': ')[1];;
                        const vehicleID = document.getElementById('vehicle_id').textContent.split(': ')[1];;
                        
                       
                        const dataToUpdate = `driverID=${encodeURIComponent(driverID)}&driverName=${encodeURIComponent(driverName)}&email=${encodeURIComponent(email)}&phone=${encodeURIComponent(phone)}&idnumber=${encodeURIComponent(idnumber)}&bookingID=${encodeURIComponent(bookingID)}&vehicleID=${encodeURIComponent(vehicleID)}`;
                        //alert(dataToUpdate);
                        // to send driver and transaction data to database data to database
                        const xhr = new XMLHttpRequest();
                        xhr.open('POST', 'sendingTrasactionandDriver.php', true);
                        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
                        xhr.onload = function() {
                         if(xhr.status === 200) {
                             alert(xhr.responseText);
                         } else{
                            alert('Error'+ xhr.status);
                         }
                        }
                        xhr.send(dataToUpdate);
                    });   
                 actionButton.appendChild(bookButton);
                 row.appendChild(actionButton);

                  tBody.appendChild(row);           
                });
        });
}
document.addEventListener('DOMContentLoaded', function() {
    toshowprogressTransactions();
});

// Function to show pedding transaction to dispatcher. 
function toshowprogressTransactions(){
    fetch('showProgressTransaction.php')
        .then(response => response.text())
        .then(Transactions => {
         const tableBody = document.getElementById('assignedTodriverBookingsTable')
            tableBody.innerHTML = '';
    
                if(Transactions.trim().length > 0){
                    let rows = Transactions.trim().split('\n');
                    rows.forEach(row => {
                        let columns = row.split(',');
                        let tr = document.createElement('tr');
                        columns.forEach(column => {
                            let td = document.createElement('td');
                            td.textContent = column;
                            tr.appendChild(td);
                        });
                        tableBody.appendChild(tr);
                    });
                } else {
                    let tr = document.createElement('tr');
                    let td = document.createElement('td');
                    td.colSpan = 13;
                    td.textContent = "No information found";
                    tr.appendChild(td);
                    tableBody.appendChild(tr);
         }
    })
}


// function to hide driver list and customer information
function hideDriverListandInformation() {
    document.getElementById("assigningDriverPage").style.display = "none";
    document.getElementById("assigDriverList").style.display = "none";
}

// to display the assigned driver transaction
function assignedDriverTransaction(){
    document.getElementById("assignedDriverTransaction").style.display = "block";
    document.getElementById("completedTransport").style.display = "none";
    toshowprogressTransactions()
    hideneBbookings();
}
// to hide neBbookings
function hideneBbookings(){
    document.getElementById("dispatcher_section").style.display = "none";
}
function fetchAssigned() {
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
}

// Function to display assigned jobs in a text-based format
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

// adding an event listener to link for showing driver jobs
function displayJobsSection() {
    document.getElementById("jobsSection").style.display = "block";
    document.getElementById("completedDriverJobs").style.display = "none";
    ///fetchAssingedJobsToDriver();
    fetchAssigned();
}
// to send transaction data asynchronously to complete transaction.
function tocompleteTransaction(event){
    //prevent the default form behavior
    event.preventDefault();
       // submit the registratio form data asynchronously
       var form = document.getElementById("complete_transaction_form");
       //create a formdata for collecting form data from an htmlelemt using FormData object
       var formData = new FormData(form);//form variable represents the HNTML form element from which data will be collected.
       //creating an XMLHttpRequest object named xhr to be used to make ansynchronous requests to a server via AJAX.
       // this will not reload the entire page
       var xhr = new XMLHttpRequest();
      //opening the Request using open() - to initialize the request.
      xhr.open("POST", form.action, true); // HTTP method in the case "POST". form.action - is the URL to which request will be sent. true means the request should be asynchronous(non-blocking)
      //seting up an event Handler
      //xhr.onreadystatechange = function() {....} - assigns an anonymous function to the onreadystatechange event of xhr object
      //the function will be called whenever the readySate property of xhr object changes.
      xhr.onreadystatechange = function() {
           //check if readState is 4 (request completed) and the status is 200 (successful response).
            if (xhr.readyState == 4 && xhr.status == 200) {
               
                var messageText = document.getElementById("complete_Transaction_message_text");
                messageText.textContent = xhr.responseText;
                TodisplaySuccessMessageandRefreshpage();
                driverToUpdateVehilceForbooking();
                
            }
        };
        xhr.send(formData);
}


function driverToUpdateVehilceForbooking() {
    var vehicleID = document.getElementById("vehicleID_update").value;
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'driverToUpdateVehilce.php', true);
    // Setting the request header to indicate the content type
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            alert(xhr.responseText);
        } else {
            alert('Error: ' + xhr.status);
        }
    };
    // Sending the request with the vehicle ID as part of the request body
    xhr.send('vehicleID=' + encodeURIComponent(vehicleID));
}
function TodisplaySuccessMessageandRefreshpage(){
    // onst completeButton = document.getElementById("complete_Transaction_button");
     const messageConatiner = document.getElementById("complete_Transaction_message_container");
     messageConatiner.style.display = "block";
     
     // to automatically hide the message and refresh the page
        setTimeout(function() {
             // Hide message container
             messageConatiner.style.display = "none";
             //  To refresh the page by using window.location.reload();
             window.location.reload();
         }, 2000);
     }


    //  Fucntion to enable the clicking event for link to show completed Transport to dispatcher. 
    function toEnablelinktoshowCompletedTransportsPage() {
        document.getElementById("completedTransport").style.display = "block";
        document.getElementById("assignedDriverTransaction").style.display = "none";
        toshowCompletedTransports();
    }
// Function to show completed Transport to dispatcher. 
function toshowCompletedTransports(){       
    fetch('showCompletedTransports.php')
    .then(response => response.text())
    .then(Transports => {
        //vehicleslist - contain the data of the promise.
        // you can create a function outside this code to display the vehicle list and call the function here.
        const tableBody = document.getElementById('completeTransportTable');
        // clean existing table row
        tableBody.innerHTML = '';

        if(Transports.trim().length > 0){
            let rows = Transports.trim().split('\n');
            rows.forEach(row => {
                let columns = row.split(',');
                let tr = document.createElement('tr');
                columns.forEach(column => {
                    let td = document.createElement('td');
                    td.textContent = column;
                    tr.appendChild(td);
                });
                tableBody.appendChild(tr);
            });
        } else {
            let tr = document.createElement('tr');
            let td = document.createElement('td');
            td.colSpan = 15;
            td.textContent = "No information found";
            tr.appendChild(td);
            tableBody.appendChild(tr);
        }
    })
}


function displayCompleteJobs() {
    document.getElementById("jobsSection").style.display = "none";
    document.getElementById("completedDriverJobs").style.display = "block";
    fetchDriverCompleteJobs();
}

// Function to show completed Transport to concerned driver. 
function fetchDriverCompleteJobs() {
    var driverElement = document.getElementById('driverID');
    var driverId = driverElement.textContent.trim();
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'driverCompleteJobs.php?staff_id=' + encodeURIComponent(driverId), true);
    xhr.onload = function() {
        if(xhr.status == 200){
            var completeJobs = JSON.parse(xhr.responseText);
           // aler(jobs);
           displayDriverCompleteJobs(completeJobs);
        } else {
            alert('Error feching Complete jobs:', xhr.statusText);
        }
    }
    xhr.send();
}
function displayDriverCompleteJobs(completeJobs){
    var complete_jobsBody = document.getElementById("driverCompleteJobsTable");
    complete_jobsBody.innerHTML = '';
    completeJobs.forEach(function(job) {
        var row = document.createElement('tr');
        var job_TransactionID = document.createElement('td');
        var job_customer_name = document.createElement('td');
        var job_customer_phone = document.createElement('td');
        var job_goods_type = document.createElement('td');
        var job_goods_weight = document.createElement('td');
        var job_description = document.createElement('td');
        var job_pickup_location = document.createElement('td');
        var job_dropoff_location = document.createElement('td');
        var job_vehicle_type = document.createElement('td');
        var job_vehicle_plate = document.createElement('td');
        var job_transaction_status = document.createElement('td');
        var driver_name = document.createElement('td');
        var driver_phone = document.createElement('td');
        var customer_coments = document.createElement('td');
        var job_status = document.createElement('td');
       
       
        job_TransactionID.textContent = job.TransactionID;
        job_customer_name.textContent = job.customer_name;
        job_customer_phone.textContent = job.customer_phone;
        job_goods_type.textContent = job.goods_type;
        job_goods_weight.textContent = job.weight;
        job_description.textContent = job.description;
        job_pickup_location.textContent = job.pickup_location;
        job_dropoff_location.textContent = job.dropoff_location;
        job_vehicle_type.textContent = job.vehicle_type;
        job_vehicle_plate.textContent = job.vehicle_plate;
        driver_name.textContent = job.driver_name;
        driver_phone.textContent = job.driverphone;
        customer_coments.textContent = job.customer_comment;
        job_status.textContent = job.transaction_status;
        
        row.appendChild(job_TransactionID);
        row.appendChild(job_customer_name);
        row.appendChild(job_customer_phone);
        row.appendChild(job_goods_type);
        row.appendChild(job_goods_weight);
        row.appendChild(job_description);
        row.appendChild(job_pickup_location);
        row.appendChild(job_dropoff_location);
        row.appendChild(job_vehicle_type);
        row.appendChild(job_vehicle_plate);
        row.appendChild(driver_name);
        row.appendChild(driver_phone);
        row.appendChild(customer_coments)
        row.appendChild(job_status);
        
        complete_jobsBody.appendChild(row);
    }); 
 }

 