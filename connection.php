<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "voting_system";


    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername", $username, $password);
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // SQL query to create database
    $sql_create_db = "CREATE DATABASE IF NOT EXISTS $database";
    
    // Execute database creation query
    $conn->exec($sql_create_db);

    // Select the database
    $conn->exec("USE $database");

    // SQL query to create table
    $sql_create_table = "CREATE TABLE IF NOT EXISTS Officer (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Name VARCHAR(50) NOT NULL,
        Position VARCHAR(50) NOT NULL,
        Count VARCHAR(6) NOT NULL DEFAULT 0
    )";
    
    // Execute table creation query
    $conn->exec($sql_create_table);
    

?>