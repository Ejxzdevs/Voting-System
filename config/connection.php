<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "voting_system";
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql_create_db = "CREATE DATABASE IF NOT EXISTS $database";
    
    $conn->exec($sql_create_db);
    $conn->exec("USE $database");

    // SQL query to create table
    $sql_create_table = "CREATE TABLE IF NOT EXISTS Candidates (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Name VARCHAR(50) NOT NULL,
        Position VARCHAR(50) NOT NULL
    )";
    $conn->exec($sql_create_table);
    