<?php
session_start();
session_destroy();
// redirect to the index page:
header('Location: ../index.php');
?>