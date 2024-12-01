$(document).ready(function() {
    function validateInput() {
      let isValid = true;
  
      $(".field_erros").text("");
  
      // Validation for First Name
      const firstName = $("#first_name").val();
      if (firstName === "") {
        isValid = false;
        $("#errors_first_name").text("First Name is required.");
      }
  
      // Validation for Last Name
      const lastName = $("#last_name").val();
      if (lastName === "") {
        isValid = false;
        $("#errors_last_name").text("Last Name is required.");
      }
  
      // Validation for Date of Birth
      const dob = $("#dob").val();
      if (dob === "") {
        isValid = false;
        $("#errors_dob").text("Date of Birth is required.");
      }
  
      // Validation for Upload Image
      const uploadImg = $("#upload_img").val();
      if (uploadImg === "") {
        isValid = false;
        $("#errors_upload_img").text("Image is required.");
      }
  
      // Validation for Gender
      const gender = $("#gender").val();
      if (gender === "Select Option") {
        isValid = false;
        $("#errors_gender").text("Please select a Gender.");
      }
  
      // Validation for User Category
      const userCategory = $("#Category").val();
      if (userCategory === "Select Option") {
        isValid = false;
        $("#errors_Category").text("Please select a User Category.");
      }

       // Validation for District
    const district = $("#district").val();
    if (district === "") {
      isValid = false;
      $("#errors_District").text("District is required.");
    }

    // Validation for Block/Zone
    const block = $("#block").val();
    if (block === "") {
      isValid = false;
      $("#errors_Block").text("Block/Zone is required.");
    }

    // Validation for Village / Ward
    const village = $("#village").val();
    if (village === "") {
      isValid = false;
      $("#errors_Village").text("Village/Ward is required.");
    }

    // Validation for Postal Code
    const postal = $("#postal").val();
    if (postal === "") {
      isValid = false;
      $("#errors_Postal").text("Postal Code is required.");
    }

    // Validation for Address
    const address = $("#address").val();
    if (address === "") {
      isValid = false;
      $("#errors_Address").text("Address is required.");
    }

    // Validation for Phone Number
    const phone = $("#phone").val();
    if (phone === "") {
      isValid = false;
      $("#errors_Phone").text("Phone Number is required.");
    } else if (!isValidPhoneNumber(phone)) {
      isValid = false;
      $("#errors_Phone").text("Please enter a valid phone number.");
    }

    // Validation for Password
    const password = $("#password").val();
    if (password === "") {
      isValid = false;
      $("#errors_Password").text("Password is required.");
    }

    // Validation for Confirm Password
    const confirmPassword = $("#confirm_Password").val();
    if (confirmPassword === "") {
      isValid = false;
      $("#errors_Confirm_Password").text("Confirm Password is required.");
    } else if (confirmPassword !== password) {
      isValid = false;
      $("#errors_Confirm_Password").text("Passwords do not match.");
    }

   
    const email = $("#email").val();
    if (email === "") {
      isValid = false;
      $("#errors_Email").text("Email is required.");
    } 
    else if (!isValidEmail(email)) {
      isValid = false;
      $("#errors_Email").text("Please enter a valid email address.");
    }
    // else {
    //   // isValid = false;
    //   console.log();
    //   $.ajax({
    //     url: "check_email.php",
    //     method: "POST",
    //     data: { email: email },
    //     success: function(response) {
    //       // If the response is "true", the email already exists            
    //       if (response === 'exist') {
    //         isValid = false;
    //         console.log(isValid);
    //         $("#errors_Email").text("Passwords do not match.");
    //     } else {
    //       $("#errors_Email").text("Passwords match.");
    //     }  
    //     }
    //   }); 
      // checkEmailExistence(email, function(result) {
        
      //     if (result) {
      //         isValid = false;
      //         $("#errors_Email").text("Email already exists.");
             
      //     }
        
      // });
      
  // }
      // Add more validation rules for other fields
  
      return isValid;
    }

    function isValidEmail(email) {
        // You can implement your own email validation logic here
        // For a simple example, you can use a regular expression
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
      }
    
      function isValidPhoneNumber(phone) {
        // You can implement your own phone number validation logic here
        // For a simple example, you can check for a valid number of digits
        const phonePattern = /^\d{10}$/;        
        return phonePattern.test(phone);
      }

      function checkEmailExistence(email, callback) {
        $.ajax({
          url: "admin_email.php",
          method: "POST",
          data: { email: email },
          success: function(response) {
            // If the response is "true", the email already exists            
            if (response === 'exist') {
              callback(true);
              $("#errors_Email").text("Passwords do not match.");
          } else {
              callback(false);
          }  
          }
        });        
       
      }
  
    $("#admin_form").submit(function() {
      return validateInput();
    });
  });


  
  