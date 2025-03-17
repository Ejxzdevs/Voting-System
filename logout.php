<?php
if (isset($_GET['role']) && $_GET['role'] === 'admin') {
    session_start();
    unset($_SESSION['username']);
    header("Location: login.php");
} else {
    session_start();
    session_unset();
    header("Location: index.php");
}
exit();