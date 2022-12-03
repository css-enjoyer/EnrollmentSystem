<?php
    $conn = new mysqli("localhost:3310", "root", "0413", "schoolenrollment");
    if($conn -> connect_error) {
        die ("Connect Error (".$conn->connect_Errorno.") ".$conn->connect_error);
    }
    $sql = "SELECT * FROM schoolenrollment.Courses";
    $result = $conn -> query($sql);
    $conn -> close();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Enrollment</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;800&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="navsection">
            <div class="logo-container">
                <img href="images/ustseal.png">
            </div>
            <ul>
                <li>Notifications</li>
                <li>Messages</li>
                <li>Logout</li>
            </ul>
        </div>
        <div class="mainsection">
            <h1>Become a Thomasian!</h1>
            <form action="" method="POST">
                <fieldset>
                <legend>Student Information</legend>
                    <label>First Name: <input type="text" name="FNAME"></label>
                    <label>Middle Initial: <input type="text" name="MI"></label>
                    <label>Last Name: <input type="text" name="LNAME"></label>
                    <label>Gender: <select>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select></label>
                    <label>Date of Birth: <input type="date"></label>
                    <label>Desired Department: <select>
                        <option value="cs">Computer Science</option>
                        <option value="it">Information Technology</option>
                        <option value="is">Information Systems</option>
                    </select></label>
                </fieldset>
                <input type="submit" value="Proceed" />
            </form>
        </div>
    </body>
</html>
