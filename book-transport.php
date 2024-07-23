<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>book-transport</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="booking.css">
   
    <script src="bookingtransport.js"></script>
</head>
<body>
<div class="dashboard_container">
    <div class="company-logo">
        <p><span class="logo_logo1">c<span class="logo_logo2">N</span><span class="logo_logo3">T</span>s</span></p>
        <div class="logo_text">
        <span class="logo_text1">C<span class="logo_text2">amson</span><span class="logo_text3">N<span class="logo_text4">orm</span></span><span class="logo_text5">T</span><span  class="logo_text6">ransport</span></span>
        </div>
       
    </div>
    <div class="user-profile">
        <a href="#" onclick="toopenUserprofile()">MY PROFILE</a>
    </div>
   <!-- to display username -->
    <div>
      <div class="welcome_user">
      <?php
       session_start();
       if(isset($_SESSION['username'] ) && isset($_SESSION['user_id'] )) {
        // this line check if the usernme index is set in the $_SESSION superglobal array. the isset() fucntion is used to determine if a variable is declared and is different than null
       
        echo '<p>welcome, ' . $_SESSION['username'] . '!</p>';
        echo '<p id="customer_ID">' .  $_SESSION['user_id'] . '</p>';
       } else {
       // redirect to loggin
       header('Location: index.html');
       exit;
       }
       ?>
      </div>
      
    </div>
       <!-- end of displaying of username -->

    <div class="customer-links" id="">
      <nav-link>
        <li><a href="home.html">HOME</a></li>
        <li><a href="#our_Servives">OUR SERVICES</a></li>
        <li><a href="#about_Us">ABOUT US</a></li>
        <li><a href="#contact_Us">CONTACT US</a></li>
        <li><a href="logout.php">LOGOUT</a></li>
      </nav-link>
    </div>
    
    <div>
        <div class="vehicle_available_div" id="vehicle_available_div">
            <h1>Vehicle Available</h1>
            <!-- <p id="back_to_goods_information">Back to goods form</p> -->
            <table id="Available_vehicle_list">
                 <thead>
                     <tr>
                         <th>Vehicle ID</th>
                         <th>Type</th>
                         <th>Capacity</th>
                         <th>Plate Number</th>
                         <th>Make</th>
                         <th>Model</th>
                         <th>Action</th>
                     </tr>
                 </thead>
                 <tbody id="Available_vehicle_list_table"  class="Available_vehicle_list_table" > 
                    <!-- vehicle list will be displayed on this section -->
                 </tbody>
                </table>
        </div>

    <!-- <button type="button" onclick="openButton()">open</button> -->

      <div class="dashboard_content">
        <p>Access our servicess on this links</p>
        <ul>
            <li><a href="#" onclick="displayCustomerIformation()">Book Transport</a></li>
        </ul>
        <div class="content_Container">
            <!-- dashboar content -->
            <div class="content-of-dashboard">
                <h1>Are Your transporting a bulkey goods!. Here is a solution</h1>
                <p >Our trasnporting company makes your Happy with amazing transport services.<br>
                    Click <a href="#" onclick="displayCustomerIformation()">here to book a vehicle</a> of your wish to solve your trasnport problems for once. <br>
                   We offer a conveninces, in time services and fast delivery of your trasnport.<br>
                   We provide the following transport services</p>
                <div class="content-of-dashboard_links">
                    <a href="#" onclick="displayCustomerIformation()">Lory Transport</a> <p>You can book a Lory of your desire Capacity by clicking on lory</p>
                    <a href="#" onclick="displayCustomerIformation()">Truck Transport</a> <p>You can book a Truck of your desire Capacity by clicking on Truck</p>
                    <a href="#" onclick="displayCustomerIformation()">PickUp Transport</a> <p>You can book a PickUp of your desire Capacity by clicking on Pickup</p>
                </div>
                
            </div>
            <div class="content-of-dashboard">
                <div class="Transport_service_portfolio">
                    <h1>Transport Services Portfolio</h1>
                    <div class="image_text">
                         <span id="lory">LORY TRANSPORT</span>
                         <span id="truck" style="display: none;">TRUCK TRANPORT</span>
                        <span id="pickup" style="display: none;">PICKUP TRANSPORT</span>
                    </div>
                   
                    <div class="image-portfolio">
                    <p id="image1" class="image"><img src="images/img2.jpg" style="margin-left: -100px; padding: 10px; height: 450px; width: 600px;" alt="loading..."></p>
                    <p id="image2" class="image"><img src="images/img3.jpg" style="margin-left: -100px; padding: 10px; height: 450px; width: 600px;" alt="loading..."></p>
                    <p id="image3"class="image"><img src="images/img5.jpg" style="margin-left: -100px; padding: 10px; height: 450px; width: 600px;" alt="loading..."></p>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <!-- user profile dsection   -->
    <div class="user_profile_container" id="user_profile_container">
        <div class="user_profile_page">

            <h1>Your profile</h1>
            <p id="F_name"></p>
            <p id="L_name"></p>
            <p id="C_username"></p>
            <p id="C_phone"></p>
            <p id="C_email"></p>
            <button type="button">Update Profile</button>

            <h2>my Booking History</h2>
           <div class="Tranports_buttons">
               <button type="button" class="pending_Transport" onclick="getPendingTransport()">Pending Transport</button>
               <button type="button" class="complete_Transport" onclick="getBookingHistory()">Transport History</button>
           </div>
            
            <span class="close_userprofile_button" onclick="hideUserprofile()" style="font-size: larger;">&times;</span>

            <div class="pendingTransport" id="pendingTransport">
                <p>PENDING TRANSPORTS</p>

                <table class="pending_Transport_DIV" id="pending_Transport_DIV">
                    <thead>
                        <tr>
                            <th>Goods Type</th>
                            <th>Weight</th>
                            <th>Booking Date</th>
                            <th>Pickup Location</th>
                            <th>Dropoff LOcation</th>
                            <th>driver Name</th>
                            <th>Driver Phone</th>
                            <th>Driver Email</th>
                            <th>Vehilce Type</th>
                            <th>Vehilce Plate</th>
                            
                        </tr>
                        <tbody id="pending_Transport_DIVTable" class="pending_Transport_DIVTable">

                        </tbody>
                    </thead>
                </table>

            </div>
            <div class="transportHistory" id="transportHistory">
                <p>TRANSPORTS HISTORY</p>
                <table class="customerTransportHistory" id="customerTransportHistory">
                    <thead>
                        <tr>
                            <th>Goods Type</th>
                            <th>Weight</th>
                            <th>Booking Date</th>
                            <th>Pickup Location</th>
                            <th>Dropoff LOcation</th>
                            <th>driver Name</th>
                            <th>Driver Phone</th>
                            <th>Time Taken</th>
                            <th>Payment Method</th>
                            <th>Payment Number</th>
                            <th>Payment Code</th>
                            <th>Amount Paid</th>
                        </tr>
                        <tbody id="customerTransportHistoryTable" class="customerTransportHistoryTable">

                        </tbody>
                    </thead>
                </table>
            </div>



        </div>
    </div>
   
    <!-- end of user profile section -->

    <div class="booking-form" >
        <div id="booking-formGoodsInformation">
            <p id="back-to-dashboard">Back</p>
        <form action="#" class="custom-information-form" id="custom-information-form" method="post" >
            <div class="customer-information-feilds" id="goods-information">
                <div class="customer-feild-information" id="goods-information">
                    <h1>Goods Information</h1>
                    <label for="">choose type of goods</label>
                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                    <p style="color: red; position: absolute; top: 17%; left: 40%; display: none;"  id="error_display_goodsType">*</p>
                    <select name="goods-type" id="goods-status">
                         <option value="">select goods type</option>
                         <option value="perishable" name="goods-status" id="goods-status">Perishable</option>
                         <option value="fragile" name="goods-status" id="goods-status">Fragile</option>
                         <option value="hazardous" name="goods-status" id="goods-status">Hazardous</option>
                    </select>
                    <label for="quantiy">Quantity(optional):</label>
                    <input type="text" id="quantity" name="quantity" >
                    <label for="volume">Volume (Optional):</label>
                    <input type="text" id="volume" name="volume">
                    <div class="goods_information">
                        <label for="wieght">Enter Wieght (Optional):</label>
                        <input type="text" id="weight" name="weight">
                        <label for="pickup-location">Pickup Location:</label>
                        <input type="text" id="pickup-location" name="pickup-location" ><p style="color: red; position: absolute; top: 40%; left: 90%; display: none;"  id="error_display">*</p>
                        <label for="dropoff-location">Drop-off Location:</label>
                        <input type="text" id="dropoff-location" name="dropoff-location" > <p style="position: absolute; top: 50%; left: 90%; color: red;  display: none; " id="error_display_dropoff" >*</p>
                    </div>
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" cols="50" rows="4" ></textarea>
                </div>
            </div>
            <span id="goods_input_error" style="color: red; font-size: 15px; margin-left: 57%; margin-top: -4%;  position: absolute;"></span>
            <p id="buttonContinue_booking">Continue</p>
        </form>
        </div>
           
            
    </div>
    <div class="transaction-details-show" id="transaction-details-show">
    
            
        <div class="transaction-details" id="transaction-details" >
            <h1>Transaction information</h1>
        
        
            <div id="transactionDetails">
                <p id="transactionDetails-text"><span class="transactionDetails-text">Vehicle Booked Inform:</span></p>
                <!-- to displaye the booked vehicle information -->
                <p id="vehcile_display">Vehicle Id:<p id="vehicle_ID"></p></p>
                <p id="vehcile_display">Vehicle Type:<p id="vehicle-type"></p></p>                
                <p id="vehcile_display">Vehicle Capacity: <p id="vehicle-capacity"></p></p>
                <p id="vehcile_display">Plate Number: <p id="vehicle-plate"></p></p>
            </div>
            <div id="goodsinformation" class="goodsinformation">
                <p id="goods-text-information">Goods information</p>
                <!-- to display goods information -->
                <p id="userid"></p>
                <p id="goodstype"></p>
                <p id="goods-quantity"></p>
                <p id="goodsVolume"></p>
                <p id="goodsWieght"></p>
                <p id="goodsPickup"></p>
                <p id="goodsDrop"></p>
                <p id="description-goods"></p>
            </div>
            
            <button type="submit" id="accept-booking">Accept</button>
            <button type="cancle" id="ddd">Cancel</button>  <!--  user can cancel the information if he or she feels to change car booked -->
            <span class="close-button" onclick="closeTransactionPagedetails()">&times;</span>
            <!-- massage handling response -->
            <div id="customerMassage" style="color: red; font-size: 13px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif"></div>
           
            
        </div>
        
     
    </div>
   
    <div class="customer_booking_success_page" id="customer_booking_success_page">
        <button id="back_to_Home">Back To Home</button>
        <div class="customer_services_page">
            <h1>Thank For Choosing Our Transport Services!</h1>
            <p class="service_p">We will Always do our Best to server You.</p>
            <p class="services_message">You will receive a call phone from our Dispatcher.</p>
            <p class="services_message">You will be given a way forward on the payment method.</p>
            <p class="services_message">Payment is on delivery.</p>
            <p class="services_message" id="services_message">Thank you for staying with us!.</p>

            <button type="button" id="back_to_Homepage" onclick="buttonRefleshPage()">Back to Home page</button>

            <button type="button" id="view_booking_history" onclick="buttonRefleshPage_OpenBookings()">View Booking History</button>
        </div>
    </div>
    
   
    
    <footer class="customer-dashboar-footer">
        <div class="footer-content" id="contact_Us">
             <h1>Contact Us</h1>
             <p  id="footer-p">Phone:  +254782419389</p>
             <p  id="footer-p">Email-Address:  camsontransport@gmail.com</p>
        </div>
        <div class="footer-content" id="our_Servives">
            <h1>Our Services</h1>
            <p id="footer-pp">Our journey towards success is intertwined with the satisfaction
                 and happiness of our valued Transportation. </p>
            <p  id="footer-pp">With a passion for excellence,
                we continuously strive to surpass expectations, 
               going above and beyond to ensure your complete satisfaction.</p>
            <p></p>
        </div>
        <div class="footer-content" id="about_Us">
            <h1>About Us</h1>
            <p  id="footer-p">we provide the following services</p>
            <ul>
                <li><a href="">Big Truck Transportation</a></li>
                <li><a href="">Lories Transportation</a></li>
                <li><a href="">Containers Transportation</a></li>
                <li><a href="">PickUp Transportation</a></li>
            </ul>
            <hr style="position: absolute; width: 80%;  right: 9%; margin-top: 40px;">
        
        <div class="company-name">
            <p>CAMSONTRANSPORTCOMPANY</p>
        </div>

        <div class="copy">
            <p>&copy; 2024camsontransportcompany.All rights reserverd.</p>
        </div>
    </footer>
</div>
<script>
    const images = document.querySelectorAll('.image');
    const texts = document.querySelectorAll('.image_text span');
    let currentIndex = 0;
    //to immediately display the first immage
    images[currentIndex].style.right = '0';
    texts[currentIndex].style.display = 'block';
    setTimeout(() => {
        setInterval(() => {
        const previousIndex = currentIndex;
        currentIndex = (currentIndex + 1) % images.length;

        images[previousIndex].style.right = '-100%';
        images[currentIndex].style.right = '10%';

        texts[previousIndex].style.display = 'none';
        texts[currentIndex].style.display = 'block';
    }, 3000);
 }, 2000);
//adding a event listener to a button to send cutomer data to database
document.getElementById("accept-booking").addEventListener('click', function() {
    sendCustomerdetails();   

});

const refreshButton = document.getElementById("close-payment");
refreshButton.addEventListener("click", function() {
    location.reload();
});  



</script> 
    
</body>
</html>