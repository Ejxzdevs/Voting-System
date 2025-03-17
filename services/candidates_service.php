<?php 
$sql_fetch_data = "SELECT 
    COUNT(votes.candidate_id) AS total_votes,
    Candidates.*, 
    positions.position_name
FROM 
    Candidates
INNER JOIN positions 
    ON Candidates.position_id = positions.position_id
INNER JOIN votes 
    ON Candidates.id = votes.candidate_id
GROUP BY 
    Candidates.id, positions.position_name
ORDER BY 
    positions.position_id;
";
$stmt = $conn->query($sql_fetch_data);
$candidates = $stmt->fetchAll(PDO::FETCH_ASSOC);

$candidates_by_type = array();

// Group candidates by Position dynamically
foreach ($candidates as $candidate) {
    $position = $candidate['position_name'];
    
    if (!isset($candidates_by_type[$position])) {
        $candidates_by_type[$position] = array();
    }

    $candidates_by_type[$position][] = $candidate;
}