<?php
$connect = mysqli_connect("localhost", "root", "", "concertsearch");
// suggestion for location
if (isset($_POST["locationQ"])) {
    $request = mysqli_real_escape_string($connect, $_POST["locationQ"]);
    $query = "
 SELECT city, county FROM venue WHERE city LIKE '%" . $request . "%' OR county LIKE '%" . $request . "%'
";
    
    $result = mysqli_query($connect, $query);
    
    $data = array();
    // gets all the cities and counties based on what user typed in
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (! in_array($row["city"], $data)) {
                $data[] = $row["city"];
            }
            if (! in_array($row["county"], $data)) {
                $data[] = $row["county"];
            }
        }
        echo json_encode($data);
    }
}

// suggestions for concerts name
if (isset($_POST["concertQ"])) {
    $request = mysqli_real_escape_string($connect, $_POST["concertQ"]);
    $query = "
 SELECT concertName FROM concert WHERE concertName LIKE '%" . $request . "%'
";
    
    $result = mysqli_query($connect, $query);
    
    $data = array();
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row["concertName"];
        }
        echo json_encode($data);
    }
}

// suggestions for venues name
if (isset($_POST["venueQ"])) {
    $request = mysqli_real_escape_string($connect, $_POST["venueQ"]);
    $query = "
 SELECT venueName FROM venue WHERE venueName LIKE '%" . $request . "%'
";
    
    $result = mysqli_query($connect, $query);
    
    $data = array();
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row["venueName"];
        }
        echo json_encode($data);
    }
}
// suggestions for bands
if (isset($_POST["bandQ"])) {
    $request = mysqli_real_escape_string($connect, $_POST["bandQ"]);
    $query = "
 SELECT bandName FROM band WHERE bandName LIKE '%" . $request . "%'
";
    
    $result = mysqli_query($connect, $query);
    
    $data = array();
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row["bandName"];
        }
        echo json_encode($data);
    }
}

// suggestions for genres
if (isset($_POST["genreQ"])) {
    $request = mysqli_real_escape_string($connect, $_POST["genreQ"]);
    $query = "
 SELECT genreName FROM genre WHERE genreName LIKE '%" . $request . "%'
";
    
    $result = mysqli_query($connect, $query);
    
    $data = array();
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row["genreName"];
        }
        echo json_encode($data);
    }
}

// suggestions for the input field 'Search' on the index page
if (isset($_POST["searchAllQ"])) {
    $request = mysqli_real_escape_string($connect, $_POST["searchAllQ"]);
    $query = "
SELECT concert.concertName AS ConcertName, band.bandName AS BandName, venue.venueName AS VenueName, genre.genreName AS GenreName FROM ((((concert INNER JOIN band ON concert.bandID = band.bandID) INNER JOIN venue ON concert.venueID = venue.venueID) INNER JOIN genreLink ON concert.bandID = genreLink.bandID) INNER JOIN genre ON genreLink.genreID = genre.genreID)
WHERE concert.concertName LIKE '%" . $request . "%' OR band.bandName LIKE '%" . $request . "%' OR venue.venueName LIKE '%" . $request . "%'
";
    $result = mysqli_query($connect, $query);
    
    $data = array();
    // gets concerts, venue and bands name based on what user typed in
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (isset($row["ConcertName"]) and ! in_array($row["ConcertName"], $data)) {
                $data[] = $row["ConcertName"];
            }
            if (isset($row["VenueName"]) and ! in_array($row["VenueName"], $data)) {
                $data[] = $row["VenueName"];
            }
            if (isset($row["BandName"]) and ! in_array($row["BandName"], $data)) {
                $data[] = $row["BandName"];
            }
        }
        echo json_encode($data);
    }
}

?>