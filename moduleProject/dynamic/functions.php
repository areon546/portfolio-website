<?php

function addPostToSessionStorage($post)
{

    if (!isset($_SESSION['adminMadePosts'])) {
        $_SESSION['adminMadePosts'] = [0 => [], 1 => []];
    }

    $blogContent = $_SESSION['adminMadePosts'][0];
    $portfolioContent = $_SESSION['adminMadePosts'][1];


    $title = $post['title'];
    $blogType = $post['postType'];
    $content = $post['content'];
    $filename = getUploadedFileName('filename');

    if (isset($post['timeOfSubmission'])) {
        $time = $post['timeOfSubmission'];
    } else {
        $time = getCurrentTime();
    }

    $date = date_create($time);
    $year = date_format($date, "Y");
    $month = date_format($date, "m");
    $day = date_format($date, "d");
    $time = date_format($date, "H:i:s");

    // add to an array based on the month and dates
    if ($blogType == "blog") {
        // echo "BLOG<br>";

        if (!isset($blogContent[$year])) {
            $blogContent[$year] = [];
        }

        if (!isset($blogContent[$year][$month])) {
            $blogContent[$year][$month] = [];
        }

        if (!isset($blogContent[$year][$month][$day])) {
            $blogContent[$year][$month][$day] = [];
        }

        $blogContent[$year][$month][$day][$time] = $post;

    } else if ($blogType == "portfolio") {
        // echo "PORT<br>";

        if (!isset($portfolioContent[$year])) {
            $portfolioContent[$year] = [];
        }

        if (!isset($portfolioContent[$year][$month])) {
            $portfolioContent[$year][$month] = [];
        }

        if (!isset($portfolioContent[$year][$month][$day])) {
            $portfolioContent[$year][$month][$day] = [];
        }

        $portfolioContent[$year][$month][$day][$time] = $post;

    }

    // echo $year . $month . $day . $time;

    $_SESSION['adminMadePosts'] = [0 => $blogContent, 1 => $portfolioContent];
}

function getCurrentTime()
{
    date_default_timezone_set('Europe/London'); // https://www.php.net/manual/en/timezones.php
    return date('d-m-Y'); //  H:i:s
}

function getUploadedFileName($name)
{
    if (isset($_FILES['filename']["name"])) {
        uploadImage();
        $filename = basename($_FILES['filename']["name"]);
    } else {
        $filename = "missing";
    }
    return $filename;
}

function debugArray($array)
{
    foreach ($array as $key => $value) {
        echo $key . "=>" . $value . "<br>";
    }
}

function restructureDatabase()
{
    // load all of the data from the database here 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blogpostdatabase";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // set data from the blogposts table

    $sql = "SELECT * FROM adminmadeposts";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {

            addPostToSessionStorage($row);
        }

        // sortDatabase();

    } else {
        // echo "0 results";
    }

    $conn->close();
}


function uploadImage()
{

    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES['filename']["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $uploadOk = 0;

        try {
            $check = getimagesize($_FILES['filename']["tmp_name"]);

            if ($check !== false) {
                // echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                // echo "File is not an image.";
            }
        } catch (ValueError $e) {
        }

        // Check Errors
        // Check if file already exists
        if (file_exists($target_file)) {
            // echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES['filename']["size"] > 16_777_215) {
            // echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            // echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES['filename']["tmp_name"], $target_file)) {
                // echo "The file " . htmlspecialchars(basename($_FILES['filename']["name"])) . " has been uploaded.";
            } else {
                // echo "Sorry, there was an error uploading your file.";
            }
        }
    }

}

function sortDatabase()
{
    foreach ($_SESSION['adminMadePosts'] as $postType => $years) {
        foreach ($years as $year => $months) {
            // echo $year . "<br>";
            foreach ($months as $month => $days) {
                // echo $month . "<br>";
                foreach ($days as $day => $timestamps) {
                    // echo $day . "<br>";

                    foreach ($timestamps as $timeOfDay => $post) {
                        // echo $timeOfDay . "=>" . $post . "<br>";

                        $n = sizeof($timestamps);
                        $keysOfTimestamps = array_keys($timestamps);

                        for ($i = 0; $i < $n; $i++) {
                            for ($j = 0; $j < $n - $i - 1; $j++) {

                                $time1 = $timestamps[$keysOfTimestamps[$j]]['timeOfSubmission'];
                                $time2 = $timestamps[$keysOfTimestamps[$j + 1]]['timeOfSubmission'];

                                echo $time1 . "=>" . $time2 . "<br>";
                                // Compare two adjacent timestamps and swap if necessary
                                if (date_diff($time1, $time2)->format("%R%a days") > 0 && isset($timestamps[$keysOfTimestamps[$j]]['timeOfSubmission'])) {
                                    $temp = $timestamps[$keysOfTimestamps[$j]];
                                    $timestamps[$keysOfTimestamps[$j]] = $timestamps[$j + 1];
                                    $timestamps[$keysOfTimestamps[$j + 1]] = $temp;
                                }
                            }
                        }
                        // Assign the sorted timestamps back to the session array
                        $_SESSION['adminMadePosts'][$postType][$year][$month][$day] = $timestamps;
                    }

                }
            }
        }
    }
}