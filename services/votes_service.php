<?php 
$sql_fetch_data = "SELECT * FROM votes ";
$stmt = $conn->query($sql_fetch_data);
$votes = $stmt->fetchAll(PDO::FETCH_ASSOC);