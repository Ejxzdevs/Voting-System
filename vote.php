<?php


if(isset($_GET['id'])){
$id = $_GET['id'];

require_once('connection.php');
$stmt = $conn->prepare("SELECT * FROM Candidates WHERE id = :id");
// Bind parameters
$stmt->bindParam(':id', $id);
$stmt->execute();

if($stmt){
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $record['Count'] + 1;


    $stmt = $conn->prepare("UPDATE Candidates SET Count = :count WHERE id = :id");
            
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':count', $count);
    $stmt->execute();
    header("Location: user.php");

}else{
    echo "error";
}
$stmt->execute();


}

