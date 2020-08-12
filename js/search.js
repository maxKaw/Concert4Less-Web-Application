$(document).ready(function() {
	$("#ex2").slider({});
	$("#date").valueAsDate = new Date();
	$("#range").hide();
	$("#specific").hide();
	$("#radioSpecific").click(function() {
		$("#dateRange").slideUp();
		$("#yearRange").slideUp();
		$("#yearSpecific").slideUp();
		$("#startDateRange").prop('required', false);
		$("#endDateRange").prop('required', false);
		$("#startYearRange").prop('required', false);
		$("#endYearRange").prop('required', false);
		$("#specific").slideDown();
	});
	$('#radioRange').click(function() {
		$("#specific").slideUp();
		$("#yearRange").slideUp();
		$("#yearSpecific").slideUp();
		$("#startDateRange").prop('required', true);
		$("#endDateRange").prop('required', true);
		$("#startYearRange").prop('required', false);
		$("#endYearRange").prop('required', false);
		$('#dateRange').slideDown();
	});
	$('#radioToday').click(function() {
		$("#dateRange").slideUp();
		$("#yearRange").slideUp();
		$("#yearSpecific").slideUp();
		$("#specific").slideUp();
	});
	$('#radioTomorrow').click(function() {
		$("#dateRange").slideUp();
		$("#yearRange").slideUp();
		$("#yearSpecific").slideUp();
		$("#specific").slideUp();
	});
	$("#radioSpecificYear").click(function() {
		$("#dateRange").slideUp();
		$("#yearRange").slideUp();
		$("#specific").slideUp();
		$("#startDate").prop('required', false);
		$("#endDate").prop('required', false);
		$("#startYearRange").prop('required', false);
		$("#endYearRange").prop('required', false);
		$("#yearSpecific").slideDown();
	});
	$('#radioRangeYears').click(function() {
		$("#dateRange").slideUp();
		$("#yearSpecific").slideUp();
		$("#specific").slideUp();
		$("#startYearRange").prop('required', true);
		$("#endYearRange").prop('required', true);
		$("#startDate").prop('required', false);
		$("#endDate").prop('required', false);
		$('#yearRange').slideDown();
	});
	$('#concert').typeahead({
		source: function(query, result) 
		{
			$.ajax({
				url:"api/autoComplete.php",
				method:"POST",
				data:{concertQ:query},
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
	
	$('#genre').typeahead({
		source: function(query, result) 
		{
			$.ajax({
				url:"api/autoComplete.php",
				method:"POST",
				data:{genreQ:query},
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
	
	$('#band').typeahead({
		source: function(query, result) 
		{
			$.ajax({
				url:"api/autoComplete.php",
				method:"POST",
				data:{bandQ:query},
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
	
	$('#venue').typeahead({
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
	
	$('#location').typeahead({
		source: function(query, result) 
		{
			$.ajax({
				url:"api/autoComplete.php",
				method:"POST",
				data:{locationQ:query},
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
	
	$('#searchAll').typeahead({
		source: function(query, result) 
		{
			$.ajax({
				url:"api/autoComplete.php",
				method:"POST",
				data:{searchAllQ:query},
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
	
	function basicSearch(picLocation) {
		var reqType = $('input[name="radio"]:checked').val();
		var searchAll = $('#searchAll').val();
		var location;
		if (picLocation === undefined) {
			location = $('#location').val()
		} else {
			location = picLocation;
		}
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
			method : "GET",
			url : "api/searchEngine.php",
			data : {
				searchAllVal : searchAll,
				locationVal : location,
				dateVal : date
			},
			datatype : "json"
		}).done(function(msg) {
			var data = JSON.parse(msg);
			var table = "<div class='container'><table id='basicSearchTable' class='table table-striped table-bordered table-hover' cellspacing='0' width='100%'><thead><tr><th>Concert</th><th>Band</th><th>Venue</th><th>Location</th><th>Date</th></tr></thead><tbody>";
			$.each(data, function(i, val) {
				table += '<tr><td>' + val["ConcertName"] + '</td><td>' + val["BandName"] + '</td><td>' + val["VenueName"] + '</td><td>' + val["Location"] + '</td><td>' + val['Date'] + '</td></tr>';
			});
			table += "</tbody></table></div>";
			$('#exploreByCity').slideUp();
			$('#resultsIndex').html(table);
			$('#resultsIndex').slideDown();
			$('#basicSearchTable').DataTable();
		});
	}

	$('#picStHelens').click(function() {
		basicSearch("St.Helens");
	});

	$('#picWarrington').click(function() {
		basicSearch("Warrington");
	});
	
	$('#picRuncron').click(function() {
		basicSearch("Runcron");
	});
	
	$('#picLiverpool').click(function() {
		basicSearch("Liverpool");
	});
	
	$('#basicSearchButton').click(function() {
		basicSearch();
	});
	
	$('#advanceSearchButton').click(function() {
		var reqType = $('input[name="radio"]:checked').val();
		var band = $('#band').val();
		var genre = $('#genre').val();
		var concert = $('#concert').val();
		var venue = $('#venue').val();
		var location = $('#location').val();
		var priceRange = $('#ex2').val().split(",");
		var startPrice = (priceRange[0] * 1000) / 5; 
		var endPrice = (priceRange[1] * 1000) / 5; 
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
			method : "GET",
			url : "api/searchEngine.php",
			data : {
				bandVal : band,
				genreVal : genre,
				concertVal : concert,
				venueVal : venue,
				locationVal : location,
				dateVal : date,
				startPriceVal : startPrice,
				endPriceVal : endPrice,
			}
		}).done(function(msg) {
			var data = JSON.parse(msg);
			
			var table = "<div class='container'><table id='searchTable' class='table table-striped table-bordered table-hover' cellspacing='0' width='100%'><thead><tr><th>Concert</th><th>Band</th><th>Venue</th><th>Location</th><th>Date</th></tr></thead><tbody>";
			$.each(data, function(i, val) {
				table += '<tr><td>' + val["ConcertName"] + '</td><td>' + val["BandName"] + '</td><td>' + val["VenueName"] + '</td><td>' + val["Location"] + '</td><td>' + val['Date'] + '</td></tr>';
			});
			table += "</tbody></table></div>";
			$('#resultsSearch').html(table);
			$('#resultsSearch').slideDown();
			$('#searchTable').DataTable();
			
			
		});

	});

});


