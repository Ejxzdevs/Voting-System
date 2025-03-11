<?php
require_once 'config/connection.php';

if (isset($_GET['candidate_id']) && isset($_GET['voter_id'])) {
$cid= $_GET['candidate_id'];
$vid= $_GET['voter_id'];

$stmt = $conn->prepare("INSERT INTO votes (candidate_id,voter_id) VALUES (?,?)");
// Bind parameters
$stmt->bindParam(1, $cid);
$stmt->bindParam(2, $vid);
$stmt->execute();
header("location: voter.php");


}

