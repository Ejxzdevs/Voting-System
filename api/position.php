<?php 

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