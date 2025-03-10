<?php 
$sql_fetch_data = "SELECT id, Name,image_url, Position, Count 
FROM Candidates";
$stmt = $conn->query($sql_fetch_data);
$candidates = $stmt->fetchAll(PDO::FETCH_ASSOC);

$candidates_by_type = array();

// Group candidates by Position dynamically
foreach ($candidates as $candidate) {
    $position = $candidate['Position'];
    
    // If the position key doesn't exist, initialize it as an empty array
    if (!isset($candidates_by_type[$position])) {
        $candidates_by_type[$position] = array();
    }

    // Append the candidate to the corresponding position
    $candidates_by_type[$position][] = $candidate;
}