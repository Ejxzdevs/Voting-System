<?php 
$sql_fetch_data = "SELECT * FROM voters ORDER BY created_at DESC";
$stmt = $conn->query($sql_fetch_data);
$voters = $stmt->fetchAll(PDO::FETCH_ASSOC);