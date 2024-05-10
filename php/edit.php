
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>

    <?php

        require('dbconfig.php');

        if(isset($_GET['id'])) {
    
            $id = $_GET['id'];
            
            // Retrieve user information from the database
            $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if(!$user) {
                echo "User not found";
                exit;
            }
        } else {
            echo "User ID not provided";
            exit;
        }

    ?>
</head>
<body>
    <h1>Edit User</h1>
    <form action="update-user.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
        <label for="first_name">First Name</label><br>
        <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>"><br>
        <label for="last_name">Last Name</label><br>
        <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>"><br>
        <label for="gender">Gender</label><br>
        <input type="radio" id="gender" name="gender" value="Male" <?php if($user['gender'] == 'Male') echo 'checked'; ?>> Male
        <input type="radio" id="genderFemale" name="gender" value="Female" <?php if($user['gender'] == 'Female') echo 'checked'; ?>> Female
        <input type="radio" id="genderOthers" name="gender" value="Others" <?php if($user['gender'] == 'Others') echo 'checked'; ?>> Others<br>
        <input type='hidden' name='id' value="<?php echo $id; ?>" />
        <button type="submit">Update</button>
    </form>
</body>
</html>
