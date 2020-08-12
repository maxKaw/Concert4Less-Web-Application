<?php
$method = strtolower($_SERVER['REQUEST_METHOD']);
require_once '../api/login.php';

// $method = "get";
switch ($method) {
    case 'get':
        // handle a GET request
        $venue = $_GET['venue'] ?? "";
        $year = $_GET['year'] ?? "";

        $startYear;
        if (isset($_GET["startYear"])) {
            $startYear = $_GET["startYear"] == "" ? date("Y") : $_GET["startYear"];
        } else {
            $startYear = date("Y");
        }

        $endYear;
        if (isset($_GET["endYear"])) {
            $endYear = $_GET["endYear"] == "" ? date('Y', strtotime($startYear . " + 1 year")) : $_GET["endYear"];
        } else {
            $endYear = date('Y', strtotime($startYear . " + 1 year"));
        }

        $venueID;
        if ($venue == "") {
            $venueID = getVenueID($venue, $conn);
        } else {
            $venueID = getRandomVenue($venue, $conn);
        }

        $startDate;
        $endDate;
        if ($year != "") {
            if (is_numeric($year)) {
                $startDate = date('Y-m-d', strtotime($year . "-01-1"));
                $endDate = date('Y-m-d', strtotime($year . "-12-31"));
            } else {
                echo false;
                break;
            }
        } else {
            if (is_numeric($startYear) and is_numeric($endYear)) {
                $startDate = date('Y-m-d', strtotime($startYear . "-01-1"));
                $endDate = date('Y-m-d', strtotime($endYear . "-12-31"));
            } else {
                echo false;
                break;
            }
        }

        $query = $conn->prepare("SELECT date FROM concert WHERE venueID LIKE ? AND date BETWEEN ? AND ?");
        $query->bind_param('iss', $venueID, $startDate, $endDate);

        $query->execute();
        $result = $query->get_result();
        $array = [];

        while ($row = $result->fetch_assoc()) {
            $array[] = $row;
        }

        $query->free_result();
        $query->close();
        $conn->close();

        echo json_encode($array);
        break;
    case 'post':

        // $stmt = "DELETE FROM concert";
        // $stmt = $conn->query($stmt);
        $check = true;
        $number;
        $venue = $_POST['venueVal'] ?? "";
        $year = $_POST['dateVal'] ?? "";
        if (isset($_POST["numberVal"])) {
            $number = $_POST["numberVal"] == "" ? 1 : $_POST["numberVal"];
        } else {
            $number = 1;
        }

        if (is_array($year)) {
            if (! is_numeric($year[0]) or ! is_numeric($year[1])) {
                echo false;
                break;
            }
        } else {
            if (! is_numeric($year)) {
                echo false;
                break;
            }
        }

        $randomDate;
        for ($i = 0; $i < $number; $i ++) {
            $venueID = $venue == "" ? getRandomVenue($venue, $conn) : getVenueID($venue, $conn);
            do {
                if ($year != "") {
                    if (is_array($year)) {
                        $startYear;
                        $endYear;
                        if ($year[0] != "") {
                            $startYear = $year[0];
                        } else {
                            $startYear = date("Y");
                        }

                        if ($year[1] != "") {
                            $endYear = $year[1];
                        } else {
                            $endYear = date('Y', strtotime($startYear . " + 1 year"));
                        }
                        $randomDays = mt_rand(1, 365);
                        $randomYear = mt_rand($startYear, $endYear);
                        $randomDate = date('Y-m-d', strtotime($randomYear . "+ " . $randomDays . " days"));
                    } else {
                        $randomDays = mt_rand(1, 365);
                        $randomDate = date('Y-m-d', strtotime($year . "+ " . $randomDays . " days"));
                    }
                } else {
                    $randomDate = date("Y-m-d");
                    break;
                }
                $query = $conn->prepare("SELECT concertName FROM concert WHERE date LIKE ? AND venueID LIKE ?");
                // echo $venueID->lengths;
                // echo $randomDate;
                $query->bind_param('si', $randomDate, $venueID);
                $query->execute();
                $query->bind_result($concertName);
                $query->fetch();
                $query->free_result();
                $query->close();
                if ($concertName == "") {
                    break;
                }
            } while (true);

            $query = $conn->prepare("SELECT * FROM band");
            $query->execute();
            $result = $query->get_result();
            $numRows = $result->num_rows;
            $randomBand = mt_rand(1, $numRows);
            $query->free_result();
            $query->close();

            $query = $conn->prepare("SELECT bandName FROM band WHERE bandID LIKE ?");
            $query->bind_param('s', $randomBand);
            $query->execute();
            $query->bind_result($bandName);
            $query->fetch();
            $concertName = "Concert of " . $bandName;
            $query->free_result();
            $query->close();

            $query = $conn->prepare("INSERT INTO concert (bandID, venueID, concertName, bandName, date) VALUES (?, ?, ?, ?, ?)");
            $query->bind_param('iisss', $randomBand, $venueID, $concertName, $bandName, $randomDate);
            if ($query->execute() == true) {
                $check = true;
            } else {
                $check = false;
            }
            $query->close();
        }
        echo $check;
        break;
    case 'put':
        // handle a PUT request
        break;
    case 'delete':
        // handle a DELETE request
        parse_str(file_get_contents('php://input'), $_DELETE); // Convoluted, but allows us to access "DELETE array"
        $venue = $_DELETE["venueVal"] ?? "";
        $date = $_DELETE["dateVal"] ?? "";
        // $startDate = $_DELETE["startDateVal"] ?? "";
        // $endDate = $_DELETE["endDateVal"] ?? "";

        $stmt = "DELETE FROM concert";
        if ($venue != "") {
            $venueID = getVenueID($venue, $conn);
            if (($date != "")) {
                if (! is_array($date)) {
                    $stmt .= " WHERE date LIKE ? AND venueID LIKE ?";
                    $query = $conn->prepare($stmt);
                    $formatedDate = date('Y-m-d', strtotime($date));
                    $query->bind_param('si', $formatedDate, $venueID);
                    $query->execute();
                    $query->free_result();
                    $query->close();
                    echo true;
                } else {
                    $stmt .= " WHERE date BETWEEN ? AND ? AND venueID LIKE ?";
                    $startFormatedDate = date('Y-m-d', strtotime($date[0]));
                    $endFormatedDate = date('Y-m-d', strtotime($date[1]));
                    $query = $conn->prepare($stmt);
                    $query->bind_param('ssi', $startFormatedDate, $endFormatedDate, $venueID);
                    $query->execute();
                    $query->free_result();
                    $query->close();
                    echo true;
                }
            } else {
                echo "Specific year or range of start and end year needs to be filled";
            }
        } else {
            echo "Venue input field cannot be empty";
        }
        $conn->close();
        break;
    default:
        // Unimplemented method
        http_response_code(405);
}

function getVenueID($venueName, $conn)
{
    $query = $conn->prepare("SELECT venueID FROM venue WHERE venueName LIKE ?");
    $query->bind_param('s', $venueName);
    $query->execute();
    $query->bind_result($id);
    $query->fetch();
    $venueID = $id;
    $query->free_result();
    $query->close();
    return $venueID;
}

function getRandomVenue($venueName, $conn)
{
    $query = $conn->prepare("SELECT venueID FROM venue WHERE venueName LIKE ?");
    $query->bind_param('s', $venueName);
    $query->execute();
    $result = $query->get_result();
    $array = $result->fetch_assoc();
    $key = array_rand($array);
    $venueID = $array[$key];
    $query->free_result();
    $query->close();
    return $venueID;
}

?>

