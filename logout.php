<?php
session_start();
session_unset();

if (isset($_GET['role']) && $_GET['role'] === 'admin') {
    header("Location: login.php");
} else {
    header("Location: index.php");
}
exit();