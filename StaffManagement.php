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
        <title>Dashboard</title>
    </head>
    <body>
        <div class="main">
            <div class="navsection">
            <div class="logo-container"></div>
            <ul>
                <li>Notifications</li>
                <li>Messages</li>
                <li>Logout</li>
            </ul>
        </div>
        <div class="mainsection">
            <h1>Welcome Back!</h1>

        </div></div>
        
    </body>
</html>