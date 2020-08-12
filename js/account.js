$(document).ready(function() {
	loadEmail();
	loadBand();
	loadGenre();
	
	$.ajax({
		 url: 'api/getBands.php',
         type: 'POST',
         data: "{}",
         success: function(data){
        	 $("#favBand").html(data);
         }
	});
	$.ajax({
		 url: 'api/getGenres.php',
        type: 'POST',
        data: "{}",
        success: function(data){
       	 $("#favGenre").html(data);
        }
	});
	
	$('#decResult').hide();
	$('#changeMarketingMindFormAccount').submit(function() {
		event.preventDefault();
		newValue = $('#changeMarketing').val().trim();
		$.ajax({
			url: 'api/accountFunc.php',
            type: 'POST',
            data: {newDec : newValue},
            success: function(data){
                if(data == false){
                    $("#decResult").html("<small class='text-danger'>Error</small>");
                } else if (data == true) {
                	$("#decResult").html("<small class='text-success'>Decision changed!</small>");
                }
                $('#decResult').slideDown();
    			setTimeout(function(){
  				  $('#decResult').slideUp();
  				}, 2000);
             }
		})
	});
	
	$('#changeEmailResult').hide();
	$('#changeEmailFormAccount').submit(function() {
		event.preventDefault();
		newEmail = $("#changeEmail").val().trim();
		$.ajax({
            url: 'api/accountFunc.php',
            type: 'POST',
            data: {emailChange : newEmail},
            success: function(data){
                if(data == false){
                    $("#changeEmailResult").html("<small class='text-danger'>This email is already assigned to an account</small>");
                } else if (data == true) {
                	$("#changeEmailResult").html("<small class='text-success'>Email changed!</small>");
                	loadEmail();
                }
                $('#changeEmailResult').slideDown();
    			setTimeout(function(){
  				  $('#changeEmailResult').slideUp();
  				}, 2000);
             }
          });
	});
	
	$('#favBandResult').hide();
	$('#changeBandFormAccount').submit(function() {
		event.preventDefault();
		favBand = $("#favBand").val().trim();
		$.ajax({
            url: 'api/accountFunc.php',
            type: 'POST',
            data: {favBandChange : favBand},
            success: function(data){
                if(data == false){
                    $("#favBandResult").html("<small class='text-danger'>Error</small>");
                } else if (data == true) {
                	$("#favBandResult").html("<small class='text-success'>Favourite band changed!</small>");
                	loadBand();
                }
                $('#favBandResult').slideDown();
    			setTimeout(function(){
  				  $('#favBandResult').slideUp();
  				}, 2000);
             }
          });
	});
	
	$('#favGenreResult').hide();
	$('#changeGenreFormAccount').submit(function() {
		event.preventDefault();
		favGenre = $("#favGenre").val().trim();
		$.ajax({
            url: 'api/accountFunc.php',
            type: 'POST',
            data: {favGenreChange : favGenre},
            success: function(data){
                if(data == false){
                    $("#favGenreResult").html("<small class='text-danger'>Error</small>");
                } else if (data == true) {
                	$("#favGenreResult").html("<small class='text-success'>Favourite genre changed!</small>");
                	loadGenre();
                }
                $('#favGenreResult').slideDown();
    			setTimeout(function(){
  				  $('#favGenreResult').slideUp();
  				}, 2000);
             }
          });
	});
	function loadEmail() {
		$.ajax({  
	        type: "POST",  
	        url: "api/accountFunc.php",  
	        data: {getData : 'usersEmail'},  
	        datatype: "json",
	        success: function (data) { 
//	            var s = '<option value="-1">Please Select a Band</option>';  
//	           alert(data);
//	            for (var i = 0; i < data.length; i++) {  
//	                s += '<option value="' + data[i] + '">' + data[i] + '</option>';  
//	            }  
	        	$("#usersEmail").html("Your Email: " + data); 
	        }  
	    }); 
	}
	function loadBand() {
		$.ajax({  
	        type: "POST",  
	        url: "api/accountFunc.php",  
	        data: {getData : 'usersBand'},  
	        datatype: "json",
	        success: function (data) { 

//	            var s = '<option value="-1">Please Select a Band</option>';  
//	           alert(data);
//	            for (var i = 0; i < data.length; i++) {  
//	                s += '<option value="' + data[i] + '">' + data[i] + '</option>';  
//	            }  
	            $("#usersFavBand").html("Your favourite band is: " + data);  
	        }  
	    }); 
	}
	function loadGenre() {
		$.ajax({  
	        type: "POST",  
	        url: "api/accountFunc.php",  
	        data: {getData : 'usersGenre'},  
	        datatype: "json",
	        success: function (data) { 

//	            var s = '<option value="-1">Please Select a Band</option>';  
//	           alert(data);
//	            for (var i = 0; i < data.length; i++) {  
//	                s += '<option value="' + data[i] + '">' + data[i] + '</option>';  
//	            }  
	            $("#usersFavGenre").html("Your favourite genre is: " + data);  
	        }  
	    }); 
	}
	
});
