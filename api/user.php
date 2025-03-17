<?php
require_once '../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $stmt = $conn->prepare("SELECT username, password FROM users WHERE username = ?");
        $stmt->bindParam(1, $_POST['username']);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $hashedPassword = hash('sha512', $_POST['password']);

        if ($user && $hashedPassword === $user['password']) {
            session_start();
            $_SESSION['username'] = $user['username'];
            header("Location: ../dashboard.php");
            exit;
        } else {
            echo "<script>alert('Invalid username or password');</script>";
            echo "<script>window.location.href = '../login.php';</script>";
        }
    } else {
        echo "<script>alert('Fill all the fields')</script>";
        echo "<script>window.location.href = '../login.php';</script>";
    }
}
