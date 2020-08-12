<?php
// login.php
session_start();
$host = 'localhost';
$database = 'concertsearch';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $database);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

function sanitizeString($input)
{
    $input = strip_tags($input);
    $input = htmlentities($input);
    return stripslashes($input);
}
?>