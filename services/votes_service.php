<?php
global $conn;

$sql_fetch_data = "SELECT * FROM votes";
$stmt = $conn->query($sql_fetch_data);
$votes = $stmt->fetchAll(PDO::FETCH_ASSOC);

function getVotes($id) {
    global $conn;
    $sql_fetch_votes = "SELECT *,
    (SELECT name FROM candidates WHERE id = votes.candidate_id) AS candidate_name,
    (SELECT image_url FROM candidates WHERE id = votes.candidate_id) AS image,
    (SELECT position_name 
     FROM positions 
     WHERE position_id = (SELECT position_id FROM candidates WHERE id = votes.candidate_id)) AS position_name
FROM votes 
WHERE voter_id = :voter_id";
    $stmt = $conn->prepare($sql_fetch_votes);
    $stmt->bindParam(':voter_id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

