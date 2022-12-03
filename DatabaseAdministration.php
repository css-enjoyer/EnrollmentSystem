<?php
    $conn = new mysqli("localhost:3310", "root", "0413", "schoolenrollment");
    if($conn -> connect_error) {
        die ("Connect Error (".$conn->connect_Errorno.") ".$conn->connect_error);
    }
    $sql = "SELECT * FROM schoolenrollment.Students";
    $result = $conn -> query($sql);
    $conn -> close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="navsection">
        <div class="logo-container">
            <img src="images/ustseal.png" width="50px">
        </div>
        <ul>
            <li>Notifications</li>
            <li>Messages</li>
            <li><a href="Landing.html">Logout</a></li>
        </ul>
    </div>
    <div class="mainsection">
        <h1>School Enrollment System</h1>
    </div>
</body>
</html>