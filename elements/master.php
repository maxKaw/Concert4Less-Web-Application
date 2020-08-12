<?php
include __DIR__ . '/header.php';
session_start();
if (isset($_SESSION["entered"])) {
    if ($_SESSION["userType"] == "admin") {
        include __DIR__ . '/navLoggedInAdmin.php';
    } else {
        include __DIR__ . '/navLoggedIn.php';
    }
} else {
    include __DIR__ . '/nav.php';
}

include __DIR__ . '/slideshow.php';
?>