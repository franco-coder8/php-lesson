<?php
require('dbconfig.php');

// Retrieve and sanitize input data
$id = $_POST['id'];
$first_name = htmlspecialchars($_POST['first_name']);
$last_name = htmlspecialchars($_POST['last_name']);
$gender = htmlspecialchars($_POST['gender']);
$updated_at = date('Y-m-d H:i:s');

if(!is_numeric($id) || empty($first_name) || empty($last_name) || empty($gender) ){
header("Location: ../index.php");
exit;
}

// Update user information in the database
$stmt = $conn->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name, gender = :gender, updated_at = :updated_at WHERE id = :id");
$stmt->bindParam(':first_name', $first_name);
$stmt->bindParam(':last_name', $last_name);
$stmt->bindParam(':gender', $gender);
$stmt->bindParam(':updated_at', $updated_at);
$stmt->bindParam(':id', $id);
$stmt->execute();

header("Location: ../index.php");
exit;
?>
