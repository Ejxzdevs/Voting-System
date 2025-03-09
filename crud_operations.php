<?php
require_once('connection.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET' ) {
        if (isset($_POST['insert'])) {
            $stmt = $conn->prepare("INSERT INTO Candidates (Name, Position) VALUES (:name, :position)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':position', $position);
            
            $name = $_POST['name'];
            $position = $_POST['position'];
            $stmt->execute();
            
            header("Location: admin.php");
        } elseif (isset($_POST['update'])) {
            $stmt = $conn->prepare("UPDATE Candidates SET Name = :name, Position = :position WHERE id = :id");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':position', $position);
            $stmt->bindParam(':id', $id);
            
            $name = $_POST['name'];
            $position = $_POST['position'];
            $id = $_POST['id'];
            $stmt->execute();
            
            header("Location: admin.php");
        } elseif (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $sql_delete_record = "DELETE FROM Candidates WHERE id = :id";
            $stmt = $conn->prepare($sql_delete_record);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            header("Location: admin.php");
        }
    }

    $sql_fetch_data = "SELECT id, Name, Position, Count 
    FROM Candidates 
    ORDER BY 
        CASE Position
            WHEN 'President' THEN 1
            WHEN 'Vice President' THEN 2
            WHEN 'Secretary' THEN 3
            WHEN 'Author' THEN 4
            WHEN 'Sergeant' THEN 5
            ELSE 6 
        END;";
    $stmt = $conn->query($sql_fetch_data);
    $voters = $stmt->fetchAll(PDO::FETCH_ASSOC);
