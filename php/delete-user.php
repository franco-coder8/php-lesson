<?php
require('dbconfig.php');

$id = $_GET['id'];

if(!is_numeric($id)) {
    header("Location: ../index.php");
    exit;
}  
    // Delete user from the database
    $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    header("Location: ../index.php");
    exit;
?>
