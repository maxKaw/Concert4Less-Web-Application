<?php
include __DIR__ . '/elements/master.php';
?>
<div class="container" >
	<div class="well">
		<?php
// checking if user is logged in
if (isset($_SESSION['entered']) and $_SESSION['entered'] == true) {
    $user = $_SESSION["username"];
    echo "Welcome " . $user;
    ?>
	<p id="usersEmail"></p>
	<p id="usersFavGenre"></p>
	<p id="usersFavBand"></p>
</div>

	<div class="well">

		<form id="changeEmailFormAccount">
		<label for="changeEmail">Change your email: </label>
			<div class="input-group">
				<span class="input-group-addon"><i
					class="glyphicon glyphicon-envelope"></i></span> <input id="changeEmail"
					type="email" class="form-control" name="changeEmail"
					placeholder="Email address" required>
			</div>
				<div class="well" id="changeEmailResult">
	</div>
			<br> <input type="submit" value="Change" class="btn" id="changeEmailButton">
		</form>
	</div>
	<div class="well">
		<form id="changeBandFormAccount">
			<div class="input-group">
				<label for="favBand">Select favourite band (select one):</label> <select
					class="form-control" id="favBand" name="favBand"><option>asd</option>
				</select>
			</div>
							<div class="well" id="favBandResult">
	</div>
			<br> <input type="submit" value="Change" class="btn" id="changeBandButton">
		</form>
	</div>

	<div class="well">
		<form id="changeGenreFormAccount">
			<div class="input-group">
				<label for="favGenre">Select favourite genre (select one):</label> <select
					class="form-control" id="favGenre" name="favGenre">
				</select>
			</div>
							<div class="well" id="favGenreResult">
	</div>
			<br> <input type="submit" value="Change" class="btn" id="changeGenreButton">
		</form>
	</div>
	<div class="well">
		<form id="changeMarketingMindFormAccount">
			<div class="input-group">
				<label for="changeMarketing">Change your mind about reciving marketing information:</label> <select
					class="form-control" id="changeMarketing" name="changeMarketing">
					<option value="1">Yes, I want to recieve marketing information on my email address.</option>
					<option value="0">No, I don not want to recieve any marketing information on my email addres.</option>
				</select>
								<div class="well" id="decResult">
	</div>
			</div>
			<br> <input type="submit" value="Change" class="btn" id="changeMarketingMind">
		</form>
	</div>
</div>

<?php
} else {
    echo "<div class='well'><p>You need to log in in order to use this page!<p></div>";
}

include __DIR__ . '/elements/footer.php';
?>
<script src="js/account.js"></script>
</body>
</html>
