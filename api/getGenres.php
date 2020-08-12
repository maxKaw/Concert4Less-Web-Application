<?php
require_once 'login.php';
// gets the types and IDs of all the genres in the database
$query = "SELECT genreID, genreName from genre";
$genre = $conn->query($query);

$result = $conn->query($query);

$rows = $result->num_rows;
$string;
// creates dropdown list and sends it back
for ($i = 0; $i < $rows; $i ++) {
    $row = $result->fetch_row();
    $string .= "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
}
echo $string;
$conn->close();
?>