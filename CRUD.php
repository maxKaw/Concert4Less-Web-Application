<?php
include __DIR__ . '/elements/master.php';
?>

<div class="container">
	<h2>Web service</h2>
	<form>
		<label id="venueHelp" for="venue">Venue:</label>
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
			<input id="venue" type="text" class="form-control" name="venue"
				placeholder="Venue">
		</div>
		
		<br> 
		
		<label id="numberHelp" for="number">Number of records to create</label>
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
			<input id="number" type="text" class="form-control" name="number"
				placeholder="Number">
		</div>
		
		<br>
		
		<div class="form-inline">
			<div class="checkbox" id="radioToday">
				<label><input type="radio" name="radio" id="radioToday"
					value="today">Today </label>
			</div>

			<div class="checkbox" id="radioTomorrow">
				<label> <input type="radio" name="radio" id="radioTomorrow"
					value="tomorrow">Tomorrow
				</label>
			</div>
			<div class="checkbox" id="radioSpecific">
				<label> <input type="radio" name="radio" id="radioSpecific"
					value="specific">Pick a date
				</label>
			</div>
			<div class="checkbox" id="radioRange">
				<label> <input type="radio" name="radio" id="radioRange"
					value="range">Pick a range of dates
				</label>
			</div>
			<div id="specific" style="display: none;">
				<label> Pick a date: <input id="specificDate" type="date"
					name="specificDate" class="form-control"></label>
			</div>
			<div id="dateRange" style="display: none;">
				<label>Pick an start date: <input id="startDateRange" type="date"
					name="dateRange" class="form-control"></label> <label>Pick an end
					date: <input id="endDateRange" type="date" name="dateRange"
					class="form-control">
				</label>
			</div>
		</div>
		
		<br>

		<input type="button" value="Create" class="btn"><br>
		<input type="button" value="Read" class="btn"><br>
		<input type="button" value="Update" class="btn"><br>
		<input type="button" value="Delete" class="btn">
	</form>
</div>

<?php
include __DIR__ . '/elements/footer.php';
?>