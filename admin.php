<?php
include __DIR__ . '/elements/master.php';
?>
<div class="container">
		<?php
// checking if the user is admin
if ((isset($_SESSION['entered'])) and ($_SESSION['entered'] == true) and ($_SESSION["userType"] == "admin")) {
    ?>
<div class="panel panel-default" id="adminForm">
	<div class="panel-body">
	<h3 style="text-align: center;">Manage concerts : </h3>
	<div class="well">
	<h4 style="text-align: center;">Create concerts : </h4>
<form>
			<div class="input-group">
			<label for="venueAdmin">Venue : </label>
				<input id="venueAdminCreate" type="text" class="form-control"
					name="venueAdminCreate" value="" placeholder="Venue">
			</div>
						<div class="input-group">
			<label for="numberAdmin">Number of concerts to create: </label>
				<input id="numberAdmin" type="number" class="form-control"
					name="numberAdmin" value=""
					placeholder="Number of concerts to create">
			</div>
			<div class="checkbox" id="radioSpecificYear">
				<label> <input type="radio" name="radioAdminCreate" id="radioSpecificYear"
					value="specificYear">Pick a year
				</label>
			</div>
			<div class="checkbox" id="radioRangeYears">
				<label> <input type="radio" name="radioAdminCreate" id="radioRangeYears"
					value="rangeYears">Pick a range of years
				</label>
			</div>
			<div id="yearSpecific" style="display: none;">
				<label> Pick a year: <input id="specificYear" type="number" maxlength="4" min="2019"
					name="specificYear" class="form-control"></label>
			</div>
						<div id="yearRange" style="display: none;">
				<label>Pick an start year: <input id="startYearRange" type="number" maxlength="4" min="2019"
					name="startYearRange" class="form-control"></label> <label>Pick an end
					year: <input id="endYearRange" type="number" maxlength="4" min="2019" name="endYearRange"
					class="form-control">
				</label>
			</div>
			<br> <input type="button" value="Create" class="btn"
				id="createButtonAdmin">
</form>
	</div>

	<div class="well">
	<h4 style="text-align: center;">Delete concerts : </h4>
<form>
			<div class="input-group">
			<label for="venueAdmin">Venue : </label>
				<input id="venueAdminDelete" type="text" class="form-control"
					name="venueAdminDelete" value="" placeholder="Venue">
			</div>
			<div class="checkbox" id="radioToday">
				<label><input type="radio" name="radioAdmin" id="radioToday"
					value="today">Today </label>
			</div>
			<div class="checkbox" id="radioTomorrow">
				<label> <input type="radio" name="radioAdmin" id="radioTomorrow"
					value="tomorrow">Tomorrow
				</label>
			</div>
			<div class="checkbox" id="radioSpecific">
				<label> <input type="radio" name="radioAdmin" id="radioSpecific"
					value="specific">Pick a date
				</label>
			</div>
			<div class="checkbox" id="radioRange">
				<label> <input type="radio" name="radioAdmin" id="radioRange"
					value="range">Pick a range of dates
				</label>
			</div>
			<div id="specific" style="display: none;">
				<label> Pick a date: <input id="specificDate" type="date"
					name="specificDate" class="form-control"></label>
			</div>
						<div id="dateRange" style="display: none;">
				<label>Pick an start date: <input id="startDateRange" type="date"
					name="startDateRange" class="form-control"></label> <label>Pick an end
					date: <input id="endDateRange" type="date" name="endDateRange"
					class="form-control">
				</label>
			</div>

			<input type="button" value="Delete"
				class="btn" id="deleteButtonAdmin">
</form>
	</div>
	</div>
	</div>
	<div class="well" id="adminFormResults">
	</div>
</div>

<?php
} else {
    echo "<div class='well'><p>You need to log in in order to use this page!<p></div>";
}

include __DIR__ . '/elements/footer.php';
?>
<script src="js/admin.js"></script>
</body>
</html>
