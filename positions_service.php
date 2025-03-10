<?php

$sql_fetch_data = "SELECT * FROM positions";
$stmt = $conn->query($sql_fetch_data);
$positions = $stmt->fetchAll(PDO::FETCH_ASSOC);