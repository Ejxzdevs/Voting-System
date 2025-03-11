<?php
session_start();

if (isset($_POST['add_voter'])) {
    if (!empty($_POST['voter_name'])) {
        $stmt = $conn->prepare("INSERT INTO voters (voter_name) VALUES (?)");
        $stmt->bindParam(1, $_POST['voter_name']);
        $stmt->execute();

        // Get the last inserted ID
        $lastInsertId = $conn->lastInsertId();
        $_SESSION['voter_id'] = $lastInsertId;
        $_SESSION['voter_name'] = $_POST['voter_name'];

        echo "<script>alert('Successfully registered');</script>";
        echo "<script>window.location.href = 'voter.php';</script>";
        exit;
    } else {
        echo '<script>alert("Registration failed. Please try again.");</script>';
    }
}

