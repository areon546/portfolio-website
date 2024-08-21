<?php
session_start();

foreach ($_SESSION as $day => $value) {
    echo $_SESSION[$day];
    unset($_SESSION[$day]);
}


// header('Location: ' . $_SERVER['REFERER']); // to redirect to the previous page
header('Location: /moduleProject/index.php');
die(); // https://stackoverflow.com/questions/768431/how-do-i-make-a-redirect-in-php https://thedailywtf.com/articles/WellIntentioned-Destruction prevents some weird behaviour but i guess thats outside the scope of the course