//fetching the user data session 
fetch('login.php')
     .then(response = response.json())
     .then(userdata => {
        //display username and role on the loged in page
        document.getElementById("showusername").textContent = userdata.username;
        document.getElementById("showrole").textContent = userdata.role;
     });

// function to show registration options(customer or staff).
function toggleRegisterOptions(){
    //show registration options
    document.getElementById('register-options').classList.toggle('active');
    //.classlist.toggle is used to toggle the presences of a class on an HTML elemet's list ofclasses.
}
// fuction to close the Registration obtions
function toggleRemoveRegistrationOptions() {
    document.getElementById('register-options').classList.remove('active');
    //remove the active.
}
//function to show customer registration form
function toggleCustomerRegistrationForm(){
    document.getElementById("customer-form").style.display = "block";
    document.getElementById("customer-registration-form").style.display = "block"; // Show the overlay
}
//fucntion to open login form after successfull customer registration
function openLoginForm(event){
    //prevent the default form submission behavior
    event.preventDefault();

    // create a variable to hold customer validation function
    var isCustomerFormValid = validateCustomerRegistrationForm();
    if (isCustomerFormValid) {
          // submit the registratio form data asynchronously AJAX - Asynchronous Javascript XMLHttpRequest.
          //creating a variable to get the form data to be submited
           var form = document.getElementById("customer-form-reg");
           //creating a new FormData object formData to hold the form data from customer form registration to prepare to send data via XMLHttpRequest.
           var formData = new FormData(form);
           //creating an new XMLHttpRequst xhr
           var xhr = new XMLHttpRequest();
           //open the post method and set it to  tru.
           xhr.open("POST", form.action, true);
           //set an event handler and set to a function to be called when readyState property of the XMLHttpRequest object changes.
           xhr.onreadystatechange = function() { // function() is an anonymous functiondefines what will happen on readystatechange event occure
          if (xhr.readyState === 4 && xhr.status === 200) {
            //xhr.readyStae == 4 means that the XMLHttpRequest is complete or use xhr.readyState === XMLHttpRequet.DONE 
            //xhr.readyStae == 200 response code was successful.
               // After successful registration, open the login form for customer to login.
               toggleLoginForm();
           }
       };
       //send customer details using a send() method.
     xhr.send(formData);
     }

    
 }
 //function to close customer-form
 function hideCustomerForm(){
    document.getElementById("customer-form").style.display = "none";
    document.getElementById("customer-registration-form").style.display = "none"; // Hide the overlay
}
//function to show staff-form
function toggleStaffRegistrationForm(){
    document.getElementById("staff-form").style.display = "block";
    document.getElementById("staff-reg-container").style.display = "block"; // Show the overlay
}
//fucntion to open login form after staff registration 
function openStaffLoginForm(event){
    //prevent the default form behavior
    event.preventDefault();

   //create a varibale to hold staff registration information.
    var isStaffFormValid = validateStaffRegistrationForm();
    if(isStaffFormValid){ 
       // submit the registratio form data asynchronously
       var form = document.getElementById("staff-reg-form");
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
                 // After successful registration, open the login form
                toggleLoginForm(); // this is the server response.
            }
        };
         //send the request using the send() method to the server
         xhr.send(formData);//formaData - it includes the data from the formData object as the request body.
    }  

}
//function to close staff-form
function hideStaffForm(){
    document.getElementById("staff-form").style.display = "none";
    document.getElementById("staff-reg-container").style.display = "none"; // Hide the overlay
}
// Fucntion to show login form
function toggleLoginForm(){
    //show Login Form
    var loginForm = document.getElementById('login-form');
    loginForm.style.display = 'block';
    document.body.classList.add('blur-background');
 }
 // Function for closing Login Form
 function hideLoginForm(){
    var loginForm = document.getElementById('login-form');
    loginForm.style.display = 'none';
    document.body.classList.remove('blur-background');
 }

 //code for image changing
 const imageUrls = [
   { url: "images/transport2.png", Text: "We offer truck services across the country."},
   { url: "images/transport1.png", Text: "welcome to our transport services"},
   { url: "images/transport4.png", Text: "Lorries transport sertvices. "},
   
 ]
 const changeimage = document.getElementById('changing-image');
 const textoverlay = document.getElementById('text-overlay');
 let currentIndex = 0;

 //function to change image
 function nextImage() {
    currentIndex = (currentIndex + 1) % imageUrls.length;
    changeimage.src = imageUrls[currentIndex].url;
    textoverlay.textContent = imageUrls[currentIndex].Text;
 }
 //set time interval
 setInterval(nextImage, 4000)


 // Inputs fileds validation
 // Validate input fields for the Customer Registration Form and Staff Registration form
 // Function to validate customer registration form
function validateCustomerRegistrationForm(){
    // decleare the variables to hold the input fields details
    var fname = document.getElementById("fname").value; // .value is used in javascript toretrieve the current value of a form input elements
    var lname = document.getElementById("lname").value;
    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("cpassword").value;
    var customerEmptyError = document.getElementById('customerEmptyError');
    var customerdetailsnameError = document.getElementById('customerdetailsnameError');
    //validate the form againest empty inputs
    if(!(fname === "" || lname === "" || username === "" || email === "" || password === "")) {
        customerEmptyError.innerText = ""; 
        //to validate username to be at least 5 characters.
        if(username.length < 5){
            customerdetailsnameError.innerText = "Username should have at leats 5 characters";
            return false;
        } else {

              //to validate email
        if(email.indexOf('@') === -1 || email.indexOf('.') === -1){
            // use the indexOf method to search for @ and . characters within the email string
            // email.indexOf('@') === -1 this check if @ character is not present in the email string 
           // email.indexOf('.') === -1 this check if . character is not present in the email string 
            customerdetailsnameError.innerText = "Enter Valid Email";
            return false;
        } else {
           //to validate if password is of 8 characters and contain a upper case later, a lower case latter and of 8 characters
           if(password.length < 8){
            customerdetailsnameError.innerText = "Password must contain at least 8 characters!";
            return false;
           } else {
            if(password !== confirmPassword){
                customerdetailsnameError.innerText = "Password and confrim password do not match.!";
                return false;
            }
            //to validate if the password has lowercase letter, uppercase letter, a digit and a special character.
            // declare variable hasLower, hasUpper, hasDigit, hasSpecial
                let hasLower = false;
                let hasUpper = false;
                let hasDigit = false;
                let hasSpecial = false;
                const specialCharacters = "!@#$%^&*_-+=[]{};:,.?";
                for(let passchar of password){
                    if (passchar >= 'a' && passchar <= 'z' ) {
                        hasLower = true;
                    } else if (passchar >= 'A' && passchar <= 'Z'){
                        hasUpper = true;
                    } else if(passchar >= '0' && passchar <= '9'){
                       hasDigit = true;
                   } else if(specialCharacters.includes(passchar)){
                      hasSpecial = true;
                   }
                }
                if(!(hasLower && hasUpper && hasDigit && hasSpecial)) {
                   customerdetailsnameError.innerText = "Password should contain at least one digit, one uppercase letter, one lowercase letter and one spacial character e.g '@'";
                   return false;
               } 
                return true;
            } 
            //  return true;
        }
    //    return true;
     }
    } else {
        customerEmptyError.innerText = "Please fill in all required fields";
        return false;
    }
}


  // Validation Staff Registration Form
    function validateStaffRegistrationForm(){
         //create variable to hold staff data.
         var staff_fname = document.getElementById("staff_fname").value;
         var staff_lname = document.getElementById("staff_lname").value;
         var staff_username = document.getElementById("staff_username").value;
         var staff_email = document.getElementById('staff_email').value;
         var staff_phone = document.getElementById("staff_phone").value;
         var staff_address = document.getElementById("staff_address").value;
         var staff_idnumber = document.getElementById("id_number").value;
         var staff_password = document.getElementById("staff_password").value;
         var staff_confirmpassword = document.getElementById("staff_cpassword").value;
         var staffErrormassage = document.getElementById("staffEmptyError");
         //to validate staff form againest empty inputs fields
         if(!(staff_fname === "" || staff_lname === "" || staff_username === "" || staff_email === "" || staff_phone === "" || staff_address === "" || staff_idnumber === "")){
            staffErrormassage.innerText = "";
            // to validate username
            if(staff_username.length < 5){
                staffErrormassage.innerText = "Username must contain at leats 5 characters!";
                return false;
            }

            //to validate email
            // declare variables atemailindex, dotemailindex
            let atemailindex = staff_email.indexOf('@');
            let dotemailindex = staff_email.indexOf('.');
            //to check if '@' is present and not the first character
                if(atemailindex <= 0){ // email.indexOf('@) === -1
                    staffErrormassage.innerText = "Enter Valid email!";
                    return false;
                } 
                //to check if '.' is present after '@' and is not the last charater
                if(dotemailindex <= atemailindex || dotemailindex === email.length - 1){
                    staffErrormassage.innerText = "Enter Valid email!";
                    return false;
                }
                //there must be character between '@' and '.'
                if(dotemailindex - atemailindex <= 1){
                    staffErrormassage.innerText = "Enter Valid Email!";
                    return false;
                }
                //to validate the phone number
                let phoneDigits = '';
                for( let i = 0; i < staff_phone.length; i++){
                    if(!isNaN(parseInt(staff_phone[i]))){
                        phoneDigits += staff_phone[i];
                    }
                }
                //chech phone number lenght
                if(!(phoneDigits.startsWith('07') || (phoneDigits.startsWith('01')) &&  phoneDigits.length === 10)){
                    staffErrormassage.innerText = "Enter valid phone number!";
                    return false;
                }
                //to validate password.
                if(staff_password !== staff_confirmpassword){
                    staffErrormassage.innerText = "Password and confrim password do not match.!";
                    return false;
                }
                 //to validate if the password has lowercase letter, uppercase letter, a digit and a special character.
                 let hasLower = false;
                 let hasUpper = false;
                 let hasDigit = false;
                 let hasSpecial = false;
                 const specialCharacters = "!@#$%^&*_-+=[]{};:,.?";
                 for(let passchar of staff_password){
                     if (passchar >= 'a' && passchar <= 'z' ) {
                         hasLower = true;
                     } else if (passchar >= 'A' && passchar <= 'Z'){
                         hasUpper = true;
                     } else if(passchar >= '0' && passchar <= '9'){
                        hasDigit = true;
                    } else if(specialCharacters.includes(passchar)){
                       hasSpecial = true;
                    }
                 }
                 if(!(hasLower && hasUpper && hasDigit && hasSpecial)) {
                    staffErrormassage.innerText = "Password should contain at least one digit, one uppercase letter, one lowercase letter and one spacial character e.g '@'";
                    return false;
                } 
                //to validate id number
                if(!(staff_idnumber.length === 8)){
                    staffErrormassage.innerText = "Id Number must be of length 8!";
                    return false;
                }
                


            return true;
         }else {
            staffErrormassage.innerText = "Please fill in all the required fields";
            return false;
         }
    }
    // forgot password reset
    function displayForgotpasswordpage(){
        document.getElementById('forgotpasswordpage').style.display = "block";
    }
    function hideForgotpasswordpage(){
        document.getElementById('forgotpasswordpage').style.display = "none";
    }

    //function to send customer and goods details to database
    function sendCustomerdetails(){
        const user_id =  document.getElementById("user_id").value;
        const goodsStatus = document.getElementById("goods-status").value;
        const Quantity = document.getElementById("quantity").value;
        const Volume = document.getElementById("volume").value;
        const weight = document.getElementById("weight").value;
        const pickupLocation = document.getElementById("pickup-location").value;
        const dropOffLocation = document.getElementById("dropoff-location").value;
        const description = document.getElementById("description").value;
        const vehicle_ID = document.getElementById("vehicle_ID").textContent;
        const vehicle_type = document.getElementById("vehicle-type").textContent;
        const vehicle_plate = document.getElementById("vehicle-plate").textContent.trim();
        const vehicle_capacity = document.getElementById("vehicle-capacity").textContent.trim();

        const dataTosend = `user_id=${encodeURIComponent(user_id)}&goodsStatus=${encodeURIComponent(goodsStatus)}&Quantity=${encodeURIComponent(Quantity)}
        &Volume=${encodeURIComponent(Volume)}&wieght=${encodeURIComponent(weight)}&pickupLocation=${encodeURIComponent(pickupLocation)}
        &dropOffLocation=${encodeURIComponent(dropOffLocation)}&description=${encodeURIComponent(description)}&vehicle_ID=${encodeURIComponent(vehicle_ID)}
        &vehicle_type=${encodeURIComponent(vehicle_type)}&vehicle_plate=${encodeURIComponent(vehicle_plate)}&vehicle_capacity=${encodeURIComponent(vehicle_capacity)}`;
     
       const xhr = new XMLHttpRequest();
       //define url for PHP script to handle the request
       const url = 'sendCustomerInfor.php';
       //define the HTTP method for the request
       const method = 'POST';
       //SET UP THE REQUEST OR OPEN A REQUEST
       xhr.open(method, url, true);
       //set the content type header to json
       xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
       //define what to happen on successfull data submission
       //handling response of the request.
       // the use of anonymous fucntion is required because the callback fucntion is required
       xhr.onload = function() {
           if(xhr.status === 200){                  
               //customerUpdateVehicle();
               
           }else{
               //error handling code.
               var massageText =  document.getElementById("customerMassage");
               massageText.textContent = 'Error' + xhr.status;
           }
       };
   
    xhr.send(dataTosend);
}