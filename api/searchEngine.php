<?php
require_once 'login.php';
// counts how many input fields were filled
$count = 0;
$variables = array();
// below checking every input field
$searchAll = isset($_GET['searchAllVal']) ? $_GET['searchAllVal'] : "";
if (! empty($searchAll)) {
    $count ++;
}
$concertName = isset($_GET['concertVal']) ? $_GET['concertVal'] : "";
if (! empty($concertName)) {
    $count ++;
}
$location = isset($_GET['locationVal']) ? $_GET['locationVal'] : "";
if (! empty($location)) {
    $count ++;
}
$date = isset($_GET['dateVal']) ? $_GET['dateVal'] : "";
if (! empty($date)) {
    $count ++;
}
$band = isset($_GET['bandVal']) ? $_GET['bandVal'] : "";
if (! empty($band)) {
    $count ++;
}
$genre = isset($_GET['genreVal']) ? $_GET['genreVal'] : "";
if (! empty($genre)) {
    $count ++;
}
$venue = isset($_GET['venueVal']) ? $_GET['venueVal'] : "";
if (! empty($venue)) {
    $count ++;
}
$startPrice = isset($_GET['startPriceVal']) ? $_GET['startPriceVal'] : "";
if (! empty($startPrice)) {
    $count ++;
}
$endPrice = isset($_GET['endPriceVal']) ? $_GET['endPriceVal'] : "";
if (! empty($endPrice)) {
    $count ++;
}
// first part of the query
$query = "SELECT concert.concertName AS ConcertName, concert.bandName AS BandName, venue.venueName AS VenueName, venue.city AS Location, concert.date AS Date FROM ((((concert INNER JOIN band ON concert.bandID = band.bandID) INNER JOIN venue ON concert.venueID = venue.venueID)";
if (! empty($genre)) {
    $query .= " INNER JOIN genreLink ON band.bandID = genreLink.bandID) INNER JOIN genre ON genreLink.genreID = genre.genreID)";
} else {
    $query .= "))";
}
// adds WHERE if any of the input field was filled
if ($count > 0) {
    $query .= " WHERE ";
}
// below adding conditionds based on what input fields were filled
if (! empty($searchAll)) {
    $query .= "(concert.concertName LIKE ?) OR (band.bandName LIKE ?) OR (venue.venueName LIKE ?)";
    for ($i = 0; $i < 3; $i ++) {
        $variables[] = $searchAll;
    }
}
if (! empty($concertName)) {
    $query .= "(concert.concertName LIKE ?)";
    $variables[] = $concertName;
    $query = addAnd($query, $count);
}
if (! empty($location)) {
    $query .= "(venue.city LIKE ? OR venue.county LIKE ?)";
    $variables[] = $location;
    $variables[] = $location;
    $query = addAnd($query, $count);
}
if (! empty($band)) {
    $query .= "(band.bandName LIKE ?)";
    $variables[] = $band;
    $query = addAnd($query, $count);
}
if (! empty($genre)) {
    $query .= "(genre.genreName LIKE ?)";
    $variables[] = $genre;
    $query = addAnd($query, $count);
}

if (! empty($venue)) {
    $query .= "(venue.venueName LIKE ?)";
    $variables[] = $venue;
    $query = addAnd($query, $count);
}

if (! empty($startPrice) and ! empty($endPrice)) {
    // price can be checked only when date is set
    if (! empty($date)) {
        // checks if user set range of dates or just specific date
        if (is_Array($date)) {
            $theStartDate = changeDate(date_create($date[0]));
            $theEndDate = changeDate(date_create($date[1]));
            if (isWeekend($theStartDate) and isWeekend($theEndDate)) {
                $query .= "band.weekendFee BETWEEN ? AND ?";
                $variables[] = $startPrice;
                $variables[] = $endPrice;
            } else {
                $query .= "band.normalFee BETWEEN ? AND ?";
                $variables[] = $startPrice;
                $variables[] = $endPrice;
            }
        } else {
            $theConvertedDate = changeDate(date_create($date));
            if (isWeekend($theConvertedDate)) {
                $query .= "band.weekendFee BETWEEN ? AND ?";
                $variables[] = $startPrice;
                $variables[] = $endPrice;
            } else {
                $query .= "band.normalFee BETWEEN ? AND ?";
                $variables[] = $startPrice;
                $variables[] = $endPrice;
            }
        }
        $query = addAnd($query, $count);
    }
}
if (! empty($date)) {
    // checks if user set range of dates or just specific date
    if (is_Array($date)) {
        $query .= "concert.date BETWEEN ? AND ?";
        $variables[] = $date[0];
        $variables[] = $date[1];
    } else {
        $query .= "concert.date LIKE ?";
        $variables[] = $date;
    }
}

$query = $conn->prepare($query);
// dynamic bind based on what input fields were filled
DynamicBind($query, $variables);

$query->execute();

$result = $query->get_result();
$rows = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($rows);

die($conn->error);
$conn->close();

// changes the format of date
function changeDate($date)
{
    $mysqltime = date_format($date, "Y-m-d");
    return $mysqltime;
}

// checks if it's weekend on the specfic date
function isWeekend($date)
{
    return (date('N', strtotime($date)) >= 6);
}

// adds AND between conditions in the query
function addAnd($query, $count)
{
    if ($count > 1) {
        $query .= " AND ";
        $GLOBALS['count'] = $count - 1;
    }
    return $query;
}

function DynamicBind($stmt, $var)
{
    if ($var != null) {
        // generate the type string
        $types = '';
        foreach ($var as $param) {
            if (is_int($param)) {
                $types .= 'i';
            } elseif (is_float($param)) {
                $types .= 'd';
            } elseif (is_string($param)) {
                $types .= 's';
            } else {
                $types .= 'b';
            }
        }

        $bind_names[] = $types;

        // loop through the given parameters
        for ($i = 0; $i < count($var); $i ++) {
            $bind_name = 'bind' . $i;
            $$bind_name = $var[$i];
            $bind_names[] = &$$bind_name;
        }

        // call the function bind_param with dynamic parameters
        call_user_func_array(array(
            $stmt,
            'bind_param'
        ), $bind_names);
    }
    return $stmt;
}

?>

