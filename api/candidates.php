<?php

function uploadImage($file) {
    $allowed = array('jpg', 'jpeg', 'png', 'gif');
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Check file type
    if (in_array($fileExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize <= 5000000) {
                // Create a unique file name
                $fileNewName = uniqid('', true) . '.' . $fileExt;
                $fileDestination = 'images/' . $fileNewName;

                // Move the uploaded file to the destination folder
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    return $fileDestination;
                } else {
                    return 'Error uploading the image!';
                }
            } else {
                return 'File size is too large! Max file size is 5MB.';
            }
        } else {
            return 'There was an error uploading your file.';
        }
    } else {
        return 'You cannot upload files of this type. Only JPG, JPEG, PNG, GIF are allowed.';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_POST['insert'])) {
        $name = htmlspecialchars(trim($_POST['name']));
        $position_id = htmlspecialchars(trim($_POST['position_id']));
        $image_url = '';

        // Handle image upload if a file is provided
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $uploadResult = uploadImage($_FILES['image']);
            if (strpos($uploadResult, 'Error') !== false) {
                echo "<script>alert('$uploadResult'); window.location.href = 'candidates.php';</script>";
                exit;
            } else {
                $image_url = $uploadResult;
            }
        }

        try {
            $stmt = $conn->prepare("INSERT INTO Candidates (Name, position_id, image_url) VALUES (?,?,?)");
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $position_id, PDO::PARAM_INT);
            $stmt->bindParam(3, $image_url);

            $stmt->execute();
            echo "<script>alert('Data inserted successfully!'); window.location.href = 'candidates.php';</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Error: " . $e->getMessage() . "'); window.location.href = 'candidates.php';</script>";
        }

    } elseif (isset($_POST['update'])) {
        $name = htmlspecialchars(trim($_POST['name']));
        $position_id = htmlspecialchars(trim($_POST['position_id']));
        $id = $_POST['id'];
        $image_url = '';

        // Check if a new image was uploaded
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $uploadResult = uploadImage($_FILES['image']);
            if (strpos($uploadResult, 'Error') !== false) {
                echo "<script>alert('$uploadResult'); window.location.href = 'candidates.php';</script>";
                exit;
            } else {
                $image_url = $uploadResult;
            }
        }

        try {
            // Update the candidate
            $stmt = $conn->prepare("UPDATE Candidates 
                SET Name = :name, 
                    position_id = :position_id, 
                    image_url = COALESCE(NULLIF(:image_url, ''), image_url)
                WHERE id = :id");

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':position_id', $position_id, PDO::PARAM_INT);
            $stmt->bindParam(':image_url', $image_url); // Only update image if a new image is provided
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

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
