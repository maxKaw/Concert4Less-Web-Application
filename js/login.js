$(document).ready(function(){
	$('#resultsLogin').hide();
	$('#loginForm').submit(function() {
		event.preventDefault();
		var username = $("#usernameInput").val();
		var password = $("#passwordInput").val();
		 $.ajax({
				method : "POST",
				url : "api/loginProcess.php",
				data : {
					usernameInput : username,
					passwordInput : password,
				}
			}).done(function(msg) {
				if (msg == true) {
					window.location.replace("index.php");
				} else if (msg == false) {
					$('#resultsLogin').slideDown();
	    			setTimeout(function(){
	    				  $('#resultsLogin').slideUp();
	    				}, 3000);
				}
			});
	});

	
});