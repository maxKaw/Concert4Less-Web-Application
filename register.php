<?php
include __DIR__ . '/elements/master.php';
?>
<div class="container">
	<div class="panel-body" id="resultsRegistration" style="text-align: center;"><h4 class='text-danger'>The username is taken or the passwords don't match each other.</h4></div>
	<form id="registrationForm">
		<h2>Registration</h2>
		<label id="usernameHelp" for="username" >Username:</label>
		<div class="input-group">
		<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
			<input id="usernameInput" type="text" class="form-control"
				name="username" value="" placeholder="Username" required>
		</div>

		<br>
		<label for="password" >Password: </label>
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
			<input pattern="(?=.*\d)(?=.*[a-z])(?=.*[!@#\$%\^&\*])(?=.*[A-Z]).{8,}" id="passwordInput" type="password" class="form-control"
				name="password" value="" placeholder="Password" title="Must contain at least one number,one uppercase letter, one lowercase letter, one special character and at least 8 or more characters" required>
		</div>

		<br>
		<label for="confirmPassword" id="confirmPasswordHelp">Confirm password: </label>
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
			<input pattern="(?=.*\d)(?=.*[a-z])(?=.*[!@#\$%\^&\*])(?=.*[A-Z]).{8,}" id="confirmPasswordInput" type="password" class="form-control"
				name="confirmPassword" value="" title="Must contain at least one number,one uppercase letter, one lowercase letter, one special character and at least 8 or more characters" placeholder="Confirm password"
				required>
		</div>

		<br>
		<label for="email" >Email address: </label>
		<div class="input-group">
			<span class="input-group-addon"><i
				class="glyphicon glyphicon-envelope"></i></span> <input id="emailInput"
				type="email" class="form-control" name="email" value=""
				placeholder="Email address" required>
		</div>

		<br>
		<div class="form-check">
			<input class="form-check-input" name="recMarketing" type="checkbox" value=""
				id="recMarketing"> <label class="form-check-label"
				for="recMarketing" > Yes, I want to recieve marketing information on my email address provided above. </label>
		</div>
		<br>
		<input type="submit" value="Register" class="btn" id="registerButton">
	</form>

</div>

<?php
include __DIR__ . '/elements/footer.php';
?>
<script src="js/register.js"></script>
</body>
</html>
