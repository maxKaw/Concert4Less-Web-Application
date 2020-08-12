<?php
require_once 'login.php';

if (isset($_POST["getData"])) {
    $userID = $_SESSION["id"];
    if ($_POST["getData"] == "usersEmail") {
        $query = $conn->prepare("SELECT emailAddress FROM user WHERE userID = ?");
        $query->bind_param("s", $userID);
        if ($query->execute() == true) {
            $query->bind_result($email);
            $query->fetch();
            echo $email;
        } else {
            echo false;
        }
    } else if ($_POST["getData"] == "usersBand") {
        $query = $conn->prepare("SELECT band.bandName FROM band INNER JOIN user ON band.bandID = user.favouriteBand WHERE user.userID = ?");
        $query->bind_param("s", $userID);
        if ($query->execute() == true) {
            $query->bind_result($band);
            $query->fetch();
            echo $band;
        } else {
            echo false;
        }
    } else if ($_POST["getData"] == "usersGenre") {
        $query = $conn->prepare("SELECT genre.genreName FROM genre INNER JOIN user ON genre.genreID = user.favouriteGenre WHERE user.userID = ?");
        $query->bind_param("s", $userID);
        if ($query->execute() == true) {
            $query->bind_result($genre);
            $query->fetch();
            echo $genre;
        } else {
            echo false;
        }
    } else {
        echo false;
    }
}

if (isset($_POST["emailChange"])) {
    $userID = $_SESSION["id"];
    $newEmail = $_POST["emailChange"];
    $query = $conn->prepare("SELECT * FROM user WHERE emailAddress LIKE ?");
    $query->bind_param("s", $newEmail);

    if ($query->execute() == true) {
        if ($query->num_rows == 0) {
            $query->free_result();
            $query->close();

            $query = $conn->prepare("UPDATE user SET emailAddress = ? WHERE userID LIKE ?");
            $query->bind_param("si", $newEmail, $userID);
            if ($query->execute() == true) {
                echo true;
            } else {
                echo false;
            }
        } else {
            echo false;
        }
    } else {
        echo false;
    }
} else {
    echo false;
}

if (isset($_POST["favBandChange"])) {
    $userID = $_SESSION["id"];
    $newBand = $_POST["favBandChange"];

    $query = $conn->prepare("UPDATE user SET favouriteBand = ? WHERE userID LIKE ?");
    $query->bind_param("si", $newBand, $userID);
    if ($query->execute() == true) {
        echo true;
    } else {
        echo false;
    }
} else {
    echo false;
}

if (isset($_POST["favGenreChange"])) {
    $userID = $_SESSION["id"];
    $newGenre = $_POST["favGenreChange"];

    $query = $conn->prepare("UPDATE user SET favouriteGenre = ? WHERE userID LIKE ?");
    $query->bind_param("si", $newGenre, $userID);
    if ($query->execute() == true) {
        echo true;
    } else {
        echo false;
    }
} else {
    echo false;
}

if (isset($_POST["newDec"])) {
    $userID = $_SESSION["id"];
    $newDec = $_POST["newDec"];

    $query = $conn->prepare("UPDATE user SET receiveMarketingInfo = ? WHERE userID LIKE ?");
    $query->bind_param("ii", $newDec, $userID);
    if ($query->execute() == true) {
        echo true;
    } else {
        echo false;
    }
} else {
    echo false;
}

?>