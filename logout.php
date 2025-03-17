<?php
if (isset($_GET['role']) && $_GET['role'] === 'admin') {
    header("Location: login.php");
} else {
    session_start();
    session_unset();
    header("Location: index.php");
}
exit();