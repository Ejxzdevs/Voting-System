<?php
require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_POST['insert'])) {

        $name = htmlspecialchars(trim($_POST['name']));
        $position = htmlspecialchars(trim($_POST['position']));

        if (isset($_FILES['image'])) {
            $file = $_FILES['image'];
            $fileName = $_FILES['image']['name'];
            $fileTmpName = $_FILES['image']['tmp_name'];
            $fileSize = $_FILES['image']['size'];
            $fileError = $_FILES['image']['error'];
            $fileType = $_FILES['image']['type'];

            // Allowed file types
            $allowed = array('jpg', 'jpeg', 'png', 'gif');
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if (in_array($fileExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize <= 5000000) {
                        $fileNewName = uniqid('', true) . '.' . $fileExt;
                        $fileDestination = 'images/' . $fileNewName;
                        try {
                            // Move the uploaded file to the destination
                            if (move_uploaded_file($fileTmpName, $fileDestination)) {
                  
                                $stmt = $conn->prepare("INSERT INTO Candidates (Name, Position, image_url) VALUES (?,?,?)");
                                $stmt->bindParam(1, $name);
                                $stmt->bindParam(2, $position);
                                $stmt->bindParam(3, $fileDestination);

                                $stmt->execute();
                                echo "<script>alert('Data inserted successfully!'); window.location.href = 'candidates.php';</script>";
                            } else {
                                echo "<script>alert('Error uploading the image!'); window.location.href = 'candidates.php';</script>";
                            }
                        } catch (PDOException $e) {
                            echo "<script>alert('Error: " . $e->getMessage() . "'); window.location.href = 'candidates.php';</script>";
                        }
                    } else {
                        echo "<script>alert('File size is too large! Max file size is 5MB.'); window.location.href = 'candidates.php';</script>";
                    }
                } else {
                    echo "<script>alert('There was an error uploading your file.'); window.location.href = 'candidates.php';</script>";
                }
            } else {
                echo "<script>alert('You cannot upload files of this type. Only JPG, JPEG, PNG, GIF are allowed.'); window.location.href = 'candidates.php';</script>";
            }
        } else {
            echo "<script>alert('No file uploaded.'); window.location.href = 'candidates.php';</script>";
        }

    } elseif (isset($_POST['update'])) {
        $name = htmlspecialchars(trim($_POST['name']));
        $position = htmlspecialchars(trim($_POST['position']));
        $image = null;
        $id = $_POST['id'];

        try {
            $stmt = $conn->prepare("UPDATE Candidates 
            SET Name = :name, 
                Position = :position, 
                image_url = COALESCE(NULLIF(:image_url, ''), image_url)
            WHERE id = :id");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':position', $position);
            $stmt->bindParam(':image_url', $image);
            $stmt->bindParam(':id', $id);

            $stmt->execute();
            echo "<script>alert('Candidate updated successfully!'); window.location.href = 'candidates.php';</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Error: " . $e->getMessage() . "'); window.location.href = 'candidates.php';</script>";
        }
    } elseif (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        try {
            $sql_delete_record = "DELETE FROM Candidates WHERE id = :id";
            $stmt = $conn->prepare($sql_delete_record);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            echo "<script>alert('Candidate deleted successfully!'); window.location.href = 'candidates.php';</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Error: " . $e->getMessage() . "'); window.location.href = 'candidates.php';</script>";
        }
    }
}

$sql_fetch_data = "SELECT id, Name,image_url, Position, Count 
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
$candidates = $stmt->fetchAll(PDO::FETCH_ASSOC);
