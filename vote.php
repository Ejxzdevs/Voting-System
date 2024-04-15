<?php


if(isset($_GET['id'])){
$id = $_GET['id'];

require_once('connection.php');
$stmt = $conn->prepare("SELECT * FROM Candidates WHERE id = :id");
            
// Bind parameters
$stmt->bindParam(':id', $id);
if($stmt){
    echo "success fetch user";
}else{
    echo "error";
}
$stmt->execute();


}

