<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <img id="logo" src="pic/logo.png" width="186" height="50" alt="Logo of the website"/>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
    </div>
        <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
      <li><a href="search.php">Search</a></li>
    </ul>

    <ul class="nav navbar-nav navbar-right">
    	<li><a href="account.php">My account</a></li>
     	<li><a href="api/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
    <p class="navbar-text navbar-right"><?php
    echo $_SESSION['username']?></p>
</div>
  </div>
</nav>