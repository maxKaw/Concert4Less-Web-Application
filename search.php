<?php
include __DIR__ . '/elements/master.php';
?>
<div style="text-align: center;" class="container">
<div id="advanceSearch">
<h2>Advance search for a concert</h2>
<div class="panel panel-default">
<div class="panel-body">
	<form>
	<div class="form-inline">
	<div class="form-group">
		<label for="band">Search band: <input autocomplete="off" class="form-control" id="band" type="text" name="band" placeholder="Band search"></label>
	</div>
	<div class="form-group">
		<label for="genre">Search genre: <input autocomplete="off" class="form-control" id="genre" type="text" name="genre" placeholder="Genre search"></label>
	</div>
	<div class="form-group">
		<label for="genre">Search venue: <input autocomplete="off" class="form-control" id="venue" type="text" name="venue" placeholder="Venue search"></label>
	</div>
	</div>
	<div class="form-inline">
	<div class="form-group">
		<label for="concert">Search concert: <input autocomplete="off" class="form-control" id="concert" type="text" name="concert" placeholder="Concert search"></label>
	</div>
	<div class="form-group">
		<label for="location">Search location: <input autocomplete="off" class="form-control" id="location" type="text" name="location" placeholder="Location search"></label>
	</div>
	<div class="form-group">
		<label for="range">Filter by price interval:<br><b>&#163;10</b> <input id="ex2" type="text" class="span2" value="" data-slider-min="10" data-slider-max="500" data-slider-step="5" data-slider-value="[100,300]"/><b>&#163;500</b></label>
	</div>
	</div>
	<div class="form-inline">
	<div class="checkbox" id="radioToday">
		<label><input type="radio" name="radio" id="radioToday" value="today" checked>Today </label>
	</div>

	<div class="checkbox" id="radioTomorrow">
		<label> <input type="radio" name="radio" id="radioTomorrow" value="tomorrow">Tomorrow</label>
	</div>
	<div class="checkbox" id="radioSpecific">
		<label> <input type="radio" name="radio" id="radioSpecific" value="specific">Pick a date</label>
	</div>
	<div class="checkbox" id="radioRange">
		<label> <input type="radio" name="radio" id="radioRange" value="range">Pick a range of dates</label>
	</div>
	<div id="specific" style="display: none;">
			<label> Pick a date:
			<input id="specificDate" type="date" name="specificDate" class="form-control"></label>
	</div>
	<div id="dateRange" style="display: none;">
			<label>Pick an start date:
			<input id="startDateRange" type="date" name="dateRange" class="form-control"></label>
			<label>Pick an end date:
			<input id="endDateRange" type="date" name="dateRange" class="form-control"></label>
	</div>
	</div>
		<br> <input type="button" value="Search" class="btn" id="advanceSearchButton">

	</form>
	</div>
	</div>
</div>
<div id="resultsSearch">
</div>
</div>

<?php
include __DIR__ . '/elements/footer.php';
?>
</body>
</html>