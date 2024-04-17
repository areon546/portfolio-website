<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "blogpostdatabase";
// Creates connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Checks connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// $password = "myPass123";
// $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
// $hashedPassword = hash('sha256', $password); // TODO this doesn't have any salt, the above line salts the string, however I don't know how to check equality with a salt so I am using this instead

// echo "Original Password: $password\n";
// echo "Hashed Password: $hashedPassword\n";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {



    // $sql = "CREATE TABLE USERS (
    //     ID int NOT NULL AUTO_INCREMENT,
    //     firstName varchar(255),
    //     lastName varchar(255),
    //     email varchar(255),
    //     password varchar(255),
    //     PRIMARY KEY (ID)
    //     );";
    $sql = "SELECT username, hashedPassword FROM admins"; // this on the phpMyAdmin server works fine, implies error beyond here
    // echo $conn->query($sql) === TRUE;

    if ($conn->query($sql) == true) { // if the SQL query works
        //YOUR CODE GOES HERE

        echo "start\n";
        $admin = $conn->query($sql)->fetch_array();
        $username = $_POST['email'];
        $password = hash('sha256', $_POST['password']);


        // if username =  && passHash
        // echo $username."\n";
        // echo $admin['username']."\n";
        // echo $password."\n";
        // echo $admin['hashedPassword']."\n";

        if ("$".$password == $admin['hashedPassword'] && $username == $admin['username']) {
            // create a session and redirect user
            $newURL = "addPost.html";
            // $newURL = "php/logout.php";

            session_start();

            if (!isset($_SESSION['UserID'])) {
                $_SESSION['UserID'] =  $username;
            }


        } else {
            // redirect user to index
            $newURL = "index.php";
        }

        $newURL = "/moduleProject/".$newURL;
        echo $newURL;
        header('Location: ' . $newURL);
        die(); // https://stackoverflow.com/questions/768431/how-do-i-make-a-redirect-in-php https://thedailywtf.com/articles/WellIntentioned-Destruction prevents some weird behaviour but i guess thats outside the scope of the course


    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}