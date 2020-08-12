$(document).ready(function(){
	$('#adminFormResults').hide();
	$("#createButtonAdmin").click( function() {
		var reqType = $('input[name="radioAdminCreate"]:checked').val();
		var venue = $('#venueAdminCreate').val().trim();
		var number = $('#numberAdmin').val();
		var date;
		switch (reqType) {
		case "rangeYears":
			date = [ $('#startYearRange').val(), $('#endYearRange').val() ];
			break;
		case "specificYear":
			date = $('#specificYear').val();
			break;
		default:
			date = "";
		}
		$.ajax({
			method : "POST",
			url : "webService/autoGenerate.php",
			data : {
				venueVal : venue,
				dateVal : date,
				numberVal : number
			},
			datatype: "json"
		}).done(function(msg) {
			if(msg == true) {
				$('#adminFormResults').html("<small class='text-success'>Concerts created !</small>");
			} else if (msg == false) {
				$('#adminFormResults').html("<small class='text-danger'>Error !</small>");
			}
			$('#adminFormResults').slideDown();
			setTimeout(function(){
				  $('#adminFormResults').slideUp();
				}, 2000);
		});
	});
	
	$('#venueAdminCreate').typeahead({
		source: function(query, result) 
		{
			$.ajax({
				url:"api/autoComplete.php",
				method:"POST",
				data:{venueQ:query},
				dataType:"json",
				success:function(data) 
				{
					result($.map(data, function(item) {
						return item;
					}));
				}
			})
		}
		
	});
	
	$('#venueAdminDelete').typeahead({
		source: function(query, result) 
		{
			$.ajax({
				url:"api/autoComplete.php",
				method:"POST",
				data:{venueQ:query},
				dataType:"json",
				success:function(data) 
				{
					result($.map(data, function(item) {
						return item;
					}));
				}
			})
		}
		
	});
	
	$("#deleteButtonAdmin").click( function() {
		var reqType = $('input[name="radioAdmin"]:checked').val();
		var venue = $('#venueAdminDelete').val().trim();
		var date;
		switch (reqType) {
		case "today":
			var fullDate = new Date();
			var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
			date = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + fullDate.getDate();
			break;
		case "tomorrow":
			var fullDate = new Date();
			var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
			date = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + (fullDate.getDate() + 1);
			break;
		case "specific":
			date = $('#specificDate').val();
			break;
		case "range":
			date = [ $('#startDateRange').val(), $('#endDateRange').val() ];
			break;
		default:
			date = "";
	}
		$.ajax({
			method : "DELETE",
			url : "webService/autoGenerate.php",
			data : {
				venueVal : venue,
				dateVal : date
			},
			datatype: "json"
		}).done(function(msg) {
			if(msg == true) {
				$('#adminFormResults').html("<small class='text-success'>Concerts deleted !</small>");
			} else if (msg == false) {
				$('#adminFormResults').html("<small class='text-danger'>Error !</small>");
			}
			$('#adminFormResults').slideDown();
			setTimeout(function(){
				  $('#adminFormResults').slideUp();
				}, 2000);
		});
	});
});