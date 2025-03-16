<?php
session_start();
require_once 'config/connection.php';

if (isset($_GET['candidate_id']) && isset($_GET['voter_id'])) {
$cid = $_GET['candidate_id'];
$vid = $_GET['voter_id'];
$position = $_GET['position'];

$stmt = $conn->prepare("INSERT INTO votes (candidate_id,voter_id) VALUES (?,?)");
$stmt->bindParam(1, $cid);
$stmt->bindParam(2, $vid);
$stmt->execute();


if (isset($_SESSION['position_array']) && is_array($_SESSION['position_array'])) {
    $_SESSION['position_array'][] = $position;
} else {
    $_SESSION['position_array'] = [$position];
}

header("location: voter.php");

}

