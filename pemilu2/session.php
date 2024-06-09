<?php
session_start();

function check_login() {
    if (!isset($_SESSION['nim'])) {
        header("Location: login.php");
        exit();
    }
}

function logout() {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
