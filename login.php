<?php
include __DIR__ . '/elements/master.php';
?>
<div class="container">
	<div class="panel-body" id="resultsLogin" style="text-align: center;"><h4 class='text-danger'>Username or password incorrect!</h4></div>
	<h2>Log in</h2>
	<form id="loginForm">
		<div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="usernameInput" type="text" class="form-control" name="usernameInput" placeholder="Username" required>
   		</div>

		<br>
		<div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input id="passwordInput" type="password" class="form-control" name="passwordInput"placeholder="Password" required>
        </div>
        <br>

			<input
			type="submit" id="loginButton" value="Log in" class="btn">

	</form>
</div>

<?php
include __DIR__ . '/elements/footer.php';
?>
<script src="js/login.js"></script>
</body>
</html>