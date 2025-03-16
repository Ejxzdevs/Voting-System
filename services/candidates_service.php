<?php 
$sql_fetch_data = "SELECT 
    Candidates.*, 
    (SELECT position_name 
     FROM positions 
     WHERE positions.position_id = Candidates.position_id) AS position_name
FROM Candidates 
INNER JOIN positions 
    ON Candidates.position_id = positions.position_id
ORDER BY positions.position_id;
";
$stmt = $conn->query($sql_fetch_data);
$candidates = $stmt->fetchAll(PDO::FETCH_ASSOC);

$candidates_by_type = array();

// Group candidates by Position dynamically
foreach ($candidates as $candidate) {
    $position = $candidate['position_name'];
    
    // If the position key doesn't exist, initialize it as an empty array
    if (!isset($candidates_by_type[$position])) {
        $candidates_by_type[$position] = array();
    }

    // Append the candidate to the corresponding position
    $candidates_by_type[$position][] = $candidate;
}