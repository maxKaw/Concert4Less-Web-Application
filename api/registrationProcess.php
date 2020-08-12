<?php
// checks if username, password and email were set
if (isset($_POST['usernameInput']) and isset($_POST['passwordInput']) and isset($_POST['emailInput'])) {
    require_once 'login.php';
    $username = $conn->real_escape_string($_POST['usernameInput']);
    $password = $conn->real_escape_string($_POST['passwordInput']);
    // hashing the password
    $salt1 = "XX54Q";
    $salt2 = "IQ9P";
    $salted_password = $salt1 . $password . $salt2;
    $hashed_password = hash('ripemd128', $salted_password);
    $email = $_POST['emailInput'];
    $recMarketing = empty($_POST['recMarketing']) ? 0 : 1;
    // registration
    $query = $conn->prepare("INSERT INTO user (username, password, emailAddress, receiveMarketingInfo) VALUES (?, ?, ?, ?)");
    $query->bind_param("sssb", $username, $hashed_password, $email, $recMarketing);
    if ($query->execute() == true) {
        $result = true;
    } else {
        $result = false;
    }
    $query->close();
    $conn->close();
    echo $result;
}
// checks if the specific username is free
if (isset($_POST['usernameCheck'])) {
    require_once 'login.php';
    $username = $conn->real_escape_string($_POST['usernameCheck']);
    $query = "SELECT username FROM user WHERE username LIKE '$username'";
    $result = $conn->query($query);
    $count = $result->num_rows;
    echo $count;
    die($conn->error);
}