<?php
session_start();

foreach ($_SESSION as $key) {
    echo $_SESSION[$key];
    $_SESSION[$key] = "";
}


header('Location: ' . $_SERVER['REFERER']);