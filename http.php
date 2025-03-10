<?php
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

    // settings

    if (isset($_POST['add_position'])) {
        if (!empty($_POST['position_name'])) {
            $stmt = $conn->prepare("INSERT INTO positions (position_name) VALUES (?)");
            $stmt->bindParam(1, $_POST['position_name']);
            $stmt->execute();
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    }
    
    if (isset($_POST['delete_position'])) {
        $position_id = $_POST['position_id'];
        if (!empty($position_id)) {
            $stmt = $conn->prepare("DELETE FROM positions WHERE position_id = ?");
            $stmt->bindParam(1, $position_id);
            $stmt->execute();
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    }
    
    if (isset($_POST['edit_position'])) {
        if (!empty($_POST['position_name']) && !empty($_POST['position_id'])) {
            $position_name = $_POST['position_name'];
            $position_id = $_POST['position_id'];
    
            $stmt = $conn->prepare("UPDATE positions SET position_name = ? WHERE position_id = ?");
            $stmt->bindParam(1, $position_name);
            $stmt->bindParam(2, $position_id);
            $stmt->execute();
    
            header("Location: " . $_SERVER['PHP_SELF']); 
            exit;
        }
    }
}


