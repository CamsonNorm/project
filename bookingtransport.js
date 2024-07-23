// function to show vehicle list available
        function vehicle_List(){
            //fetch vehilces form the database using a server
            fetch('vehiclelistavailable.php')
            .then(response => response.text())
            // this second then() callback fucntion recieve the parsed data as its argument for processing it.
            .then(data => {
                const tBody = document.getElementById('Available_vehicle_list_table');
                tBody.innerHTML = '';
                const vehicles = data.split('\n');
                vehicles.forEach(vehicle => {
                    const fields = vehicle.split(',');
                    const row = document.createElement('tr');
        
                    fields.forEach(field => {
                        const cell = document.createElement('td');
                        cell.textContent = field;
                        row.appendChild(cell);
                    });
        
                    const actionButton = document.createElement('td');
                    const bookButton = document.createElement('button');
                    bookButton.setAttribute('class', 'book_Button');
                    bookButton.innerHTML = "Book"; 
                    bookButton.addEventListener('click', function() {
                        const vehicleID = fields[0];
                        const vehicleType = fields[1];
                        const vehiclecapacity = fields[2];
                        const plateNumer = fields[3];
                        document.getElementById('vehicle_ID').textContent = vehicleID;
                        document.getElementById('vehicle-type').textContent = vehicleType;
                        document.getElementById('vehicle-plate').textContent = plateNumer;
                        document.getElementById('vehicle-capacity').textContent = vehiclecapacity;

                        showTransactionPagedetails() //to show the whole page
                        showGoodsDetails() //to show goods information
                        document.getElementById("vehicle_available_div").style.display = "none";
                    });
                 actionButton.appendChild(bookButton);
                 row.appendChild(actionButton);

                  tBody.appendChild(row);           
                });
        });
    }
        // fucntion to show transaction page details
        function showTransactionPagedetails() {
            //show transaction popup
            document.getElementById('transaction-details').style.display = 'block';
            document.getElementById('transaction-details-show').style.display = 'block';
        }
        function closeTransactionPagedetails(){
             //hide transaction popup
             document.getElementById('transaction-details').style.display = 'none';
            document.getElementById('transaction-details-show').style.display = 'none';
        }

        //call the fucntion when the page loads
        window.addEventListener('load', vehicle_List)

        //this function is to retrieve goods information
        function showGoodsDetails(){
            // event.preventDefault();
            // creating an object named goodsFormData with properties
            var goodsFormData = {
                user_id: document.getElementById("user_id").value,
                //user-id is assigned a value retreived from the HTML element with the id "user_id" using document.getElementById("user_id").value,
                // this apply to the following object goodsFormData properties.
                goodsstatus: document.getElementById("goods-status").value,
                Quantity: document.getElementById("quantity").value,
                Volume: document.getElementById("volume").value,
                wieght: document.getElementById("weight").value,
                pickupLocation: document.getElementById("pickup-location").value,
                dropOffLocation: document.getElementById("dropoff-location").value,
                description: document.getElementById("description").value
                // .value and .textContent difference
                // .value is used with form elements like input, select and textArea
                // .textContent is used to extract elements inside a p tags

            };
            
        //Display goods information
            document.getElementById("userid").innerText = "Customer ID: " +  "  "  + goodsFormData.user_id;
            document.getElementById("goodstype").innerText = "Goods Type: " +  "  "  + goodsFormData.goodsstatus;
            document.getElementById("goods-quantity").innerText = "Quantity:" +  "  "  + goodsFormData.Quantity;
            document.getElementById("goodsVolume").innerText = "Volume:"  +  " "  + goodsFormData.Volume;
            document.getElementById("goodsWieght").innerText = "Wieht: " +  " "  + goodsFormData.wieght;
            document.getElementById("goodsPickup").innerText = "PickUp Location:" + " "  + goodsFormData.pickupLocation;
            document.getElementById("goodsDrop").innerText = "Drop Off Location:"  + " "  + goodsFormData.dropOffLocation;
            document.getElementById("description-goods").innerText = "Description: "  +  " "   + goodsFormData.description;
        }

        //function to send customer and goods details to database
        function sendCustomerdetails(){
            const user_id = document.getElementById("user_id").value.trim();
            const goodsStatus = document.getElementById("goods-status").value.trim();
            const quantity = document.getElementById("quantity").value.trim();
            const volume = document.getElementById("volume").value.trim();
            const weight = document.getElementById("weight").value.trim();
            const pickupLocation = document.getElementById("pickup-location").value.trim();
            const dropOffLocation = document.getElementById("dropoff-location").value.trim();
            const description = document.getElementById("description").value.trim();
            const vehicle_ID = document.getElementById("vehicle_ID").textContent.trim();
            const vehicle_type = document.getElementById("vehicle-type").textContent.trim();
            const vehicle_plate = document.getElementById("vehicle-plate").textContent.trim();
            const vehicle_capacity = document.getElementById("vehicle-capacity").textContent.trim();

             const dataTosend = `user_id=${encodeURIComponent(user_id)}&goodsStatus=${encodeURIComponent(goodsStatus)}&quantity=${encodeURIComponent(quantity)}
             &volume=${encodeURIComponent(volume)}&weight=${encodeURIComponent(weight)}&pickupLocation=${encodeURIComponent(pickupLocation)}
             &dropOffLocation=${encodeURIComponent(dropOffLocation)}&description=${encodeURIComponent(description)}&vehicle_ID=${encodeURIComponent(vehicle_ID)}
             &vehicle_type=${encodeURIComponent(vehicle_type)}&vehicle_plate=${encodeURIComponent(vehicle_plate)}&vehicle_capacity=${encodeURIComponent(vehicle_capacity)}`;
            const xhr = new XMLHttpRequest();
            // Define the URL for the PHP script to handle the request
            const url = 'sendCustomerInfor.php';
            // Define the HTTP method for the request
            const method = 'POST';
            // Set up the request or open a request
            xhr.open(method, url, true);
            // Setting the content type header to URL encoded
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            // Define what to happen on successful data submission
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Optionally, handle successful response
                    alert(xhr.responseText);
                    customerUpdateVehicle();
                } else {
                    // Error handling code
                    const messageText = document.getElementById("customerMessage");
                    messageText.textContent = 'Error: ' + xhr.status;
                }
            };
            xhr.send(dataTosend);
        // xhr.send(dataTosend);
    }
        // function to update vehicle  status to booked
        function customerUpdateVehicle(){
            const vehicle_ID = document.getElementById("vehicle_ID").textContent;
            const update_data = `vehicle_ID=${encodeURIComponent(vehicle_ID)}`;
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'updateVehiclesCustomer.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                 if(xhr.status === 200) {
                     alert(xhr.responseText);
                     displayPaymentMethod();
                } else {
                      alert(xhr.status);
               }
            };
            xhr.send(update_data);
        }
         //function to open the payment page for a customer.
         function displayPaymentMethod(){
           document.getElementById("customer_booking_success_page").style.display = "block";
           document.getElementById("transaction-details-show").style.display = "none";
        }
        // upon openoing the payment page
        // this is the okay button for payment services.
       function acceptPayent(){
        document.getElementById('payment_service').classList.remove('active');
       }

// javascript for booking transport
function displayCustomerIformation() {
    document.getElementById("booking-formGoodsInformation").style.display = "block";
    document.getElementById("booking-formGoodsInformation").style.right = '0';
}
//back to daSHBOARD
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("back-to-dashboard").addEventListener("click", function() {
        backtoDashboard();
    })
})
//function to back to dashboard
function backtoDashboard(){
    hidegoodsInformation();
}
//function to display the list of vehiccle upon user entering goods information
function show_vehicles_tobook(){
    document.getElementById("vehicle_available_div").style.display = "block";
}
function hideVehiclestobook(){
    document.getElementById("vehicle-booking-information_container").style.display = "none";
}
//function to close goods information
function hidegoodsInformation(){
    document.getElementById("booking-formGoodsInformation").style.display = "none";
}
function displaygoodsInformation(){
    document.getElementById("booking-formGoodsInformation").style.display = "block";
}
//to add an event listener to buttonContinue_booking
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("buttonContinue_booking").addEventListener("click", function() {
        show_vehicles_tobook();
         hidegoodsInformation();
         toValidategoodsInput();
    });
});

//function to hide vehicle list for booking
function hideVehiclestobook(){
    document.getElementById("vehicle_available_div").style.display = "none";
}
//to add an event listener to returnback_booking
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("returnback_booking").addEventListener("click", function() {
        hideVehiclestobook();
        displayCustomerIformation();
    });
});

// function to display user profile
function toopenUserprofile(){
    document.getElementById("user_profile_container").style.display = "block";
    getCustomerprofile();
}
//function to hide user profile
function hideUserprofile(){
    document.getElementById("user_profile_container").style.display = "none";
}

//function to validaet goods input form
function toValidategoodsInput() {
    var goodsType = document.getElementById("goods-status").value;
    var pickUplocation = document.getElementById("pickup-location").value;
    var dropofflocation = document.getElementById("dropoff-location").value;
    var error_message = document.getElementById("goods_input_error");

    if(goodsType === "") {
        error_message.textContent = "Fill in the require input";
        document.getElementById("error_display_goodsType").style.display = "block";
        hideVehiclestobook();
        displaygoodsInformation();
    }
    if (pickUplocation === "") {
        error_message.textContent = "Fill in the require input";
        document.getElementById("error_display_pickup").style.display = "block";
        hideVehiclestobook();
        displaygoodsInformation();
    }if(dropofflocation === "") {
        error_message.textContent = "Fill in the require input";
        document.getElementById("error_display_dropoff").style.display = "block";
        hideVehiclestobook();
        displaygoodsInformation();
    }
}
document.getElementById("sendtest").addEventListener("click", function() {

});

// customer profile
document.addEventListener('DOMContentLoaded', () => {
    getCustomerprofile();
});
function buttonRefleshPage() {
   location.reload();
};
function openButton() {
    document.getElementById('customer_booking_success_page').style.display = "block";
}
// JavaScript code to handle button click
document.getElementById('view_booking_history').addEventListener('click', function() {
    // Reload the current page
    location.reload();
    // Show the hidden div after a short delay (to ensure the page is fully loaded)
    setTimeout(function() {
        var hiddenDiv = document.getElementById('user_profile_container');
        if (hiddenDiv) {
            hiddenDiv.style.display = 'block';
        }
    }, 1000); // Adjust delay as needed (in milliseconds)
});
// Show the hidden div immediately if the page is already loaded
window.addEventListener('load', function() {
    var hiddenDiv = document.getElementById('user_profile_container');
    if (hiddenDiv) {
        hiddenDiv.style.display = 'block';
    }
});

