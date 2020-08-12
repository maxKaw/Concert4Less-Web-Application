<?php
include __DIR__ . '/elements/master.php';
?>
<div style="text-align: center;" class="container">
<h2 >Search for a concert</h2>
<div class="panel panel-default">
<div class="panel-body">
	<form>
	<div class="form-inline">
	<div class="form-group">
		<label for="searchAll">Search: <input autocomplete="off" class="form-control" id="searchAll" type="text" name="searchAll" placeholder="Search"></label>
	</div>
	<div class="form-group">
		<label>Location: <input autocomplete="off" class="form-control" type="text" name="location" id="location" placeholder="Location"></label>
	</div>

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
		<input type="button" value="Search" class="btn" id="basicSearchButton">
		<input class="btn" type="button" value="Advance Search" onclick="window.location='search.php';">
	</form>
</div>
</div>

<div class="panel panel-default" id="exploreByCity">
<div class="panel-body">
<h2>Explore by city</h2>
<div class="row">
<div class="column" >
      <img id="picLiverpool" class="img-responsive img-rounded" src="pic/liverpool.jpg" alt="Liverpool picture"/>
</div>
<div class="column">
      <img id="picStHelens" class="img-responsive img-rounded" src="pic/sthelens.jpg" alt="St.Helens Picture"/>
</div>
</div>
<div class="row">
<div class="column">
      <img id="picWarrington" class="img-responsive img-rounded" src="pic/warrington.jpg" alt="Warrington Picture"/>
</div>
<div class="column">
      <img id="picRuncron" class="img-responsive img-rounded" src="pic/runcorn.jpg" alt="Runcorn Picture"/>
</div>
</div>


</div>
</div>


<div id="resultsIndex">
</div>

</div>
<?php
include __DIR__ . '/elements/footer.php';
?>
</body>
</html>