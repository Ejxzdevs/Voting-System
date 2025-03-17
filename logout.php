<?php
if (isset($_GET['role']) && $_GET['role'] === 'admin') {
    session_start();
    unset($_SESSION['username']);
    header("Location: login.php");
} else {
    session_start();
    unset($_SESSION['voter_id']);
    unset($_SESSION['position_array']);
    unset($_SESSION['voter_name']);
    echo "<script>alert('Thanks for your vote! We appreciate your participation 😊');</script>";
    echo "<script>window.location.href = 'index.php';</script>";
}
exit();