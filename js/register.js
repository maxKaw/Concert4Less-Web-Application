$(document).ready(function(){
	var usernameCheck = false;
	var passwordCheck = false;
	$('#resultsRegistration').hide();
   $("#usernameInput").keyup(function(){
      var username = $("#usernameInput").val().trim();
      if(username > ''){
         $.ajax({
            url: 'api/registrationProcess.php',
            type: 'POST',
            data: {usernameCheck:username},
            success: function(data){
                if(data > 0){
                    $("#usernameHelp").html("Username: <small class='text-danger'>Username already in use</small>");
                    usernameCheck = false;
                } else {
                	$("#usernameHelp").html("Username: <small class='text-success'>Username available</small>");
                	usernameCheck = true;
                }
             }
          });
      } else {
         $("#usernameHelp").html("Username: ");
      }
    });
   $("#confirmPasswordInput").keyup(function(){
	   password = $("#passwordInput").val().trim();
	   confirmPassword = $("#confirmPasswordInput").val().trim();
	   if (confirmPassword > '' && password > '') {
		   if (password != confirmPassword) {
			   $("#confirmPasswordHelp").html("Confirm password: <small class='text-danger'>Passwords don't match each other</small>");
			   passwordCheck = false;
		   } else {
			   $("#confirmPasswordHelp").html("Confirm password: <small class='text-success'>Password match each other</small>");
			   passwordCheck = true;
		   }
	   } else {
		   $("#confirmPasswordHelp").html("Confirm password: ");
	   }
	   
   });
   
   $('#registrationForm').submit(function(event){
	   event.preventDefault();
	   if (passwordCheck == true && usernameCheck == true) {
		   $('#results').slideUp();
		   $('.h2').slideUp();
		   var username = $('#usernameInput').val();
		   var password = $('#passwordInput').val();
		   var email = $('#emailInput').val();
		   var marketing = $('#recMarketing').val();
		   $.ajax({
				method : "POST",
				url : "api/registrationProcess.php",
				data : {
					usernameInput : username,
					passwordInput : password,
					emailInput : email,
					recMarketing : marketing
				}
			}).done(function(msg) {
				if (msg == true) {
					$('#registrationForm').slideUp();
					$('#resultsRegistration').html("<h3> Congratulations! Your account has been created! You will be logged in <span id='time'>5</span> seconds</h3>");
					$('#resultsRegistration').slideDown();
					var counter = 5;
					var interval = setInterval(function() {
					       counter--;
					       if (counter == 0) {
			    				  $.ajax({
			    					  method : "POST",
			    					  url : "api/loginProcess.php",
			    					  data : {
			    						  usernameInput : username,
			    						  passwordInput : password
			    						}
			    				  }).done(function(result) {
			    					  window.location.replace("index.php");
			    				  });
					           clearInterval(interval);
					       } else {
					    	   $('#time').html(counter);
					       }
					   }, 1000);
				} else if (msg == false) {
					$('#resultsRegistration').slideDown();
					setTimeout(function(){
						  $('#resultsRegistration').slideUp();
						}, 3000);
				}
			});
	   } else {
			$('#resultsRegistration').slideDown();
			setTimeout(function(){
				  $('#resultsRegistration').slideUp();
				}, 3000);
	   }
   });

 });