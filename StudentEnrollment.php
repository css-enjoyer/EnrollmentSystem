<?php
    $conn = new mysqli("localhost:3310", "root", "0413", "school");
    if($conn -> connect_error) {
        die ("Connect Error (".$conn->connect_Errorno.") ".$conn->connect_error);
    }
    $sql = "SELECT * FROM school.course";
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
                <img src="images/ustseal.png" width="50px">
            </div>
            <ul>
                <li>Notifications</li>
                <li>Messages</li>
                <li><a href="Landing.html">Logout</a></li>
            </ul>
        </div>
        <div class="mainsection">
            <h1>Your journey starts here!</h1>
            <form action="Enroll.php" method="POST">
                <fieldset>
                <legend>Student Information</legend>
                    <label>First Name: <input type="text" name="FNAME" required></label>
                    <label>Middle Initial: <input type="text" name="MI" required></label>
                    <label>Last Name: <input type="text" name="LNAME" required></label>
                    <label>Gender: <select name="GENDER" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select></label>
                    <label>Date of Birth: <input type="date" name="BDAY" required></label>
                </fieldset>

                <fieldset>
                <legend>Department Selection</legend>
                    <label>Department of: <select name="DEPT_ID">
                        <option value="1">Computer Science</option>
                        <option value="2">Information Technology</option>
                        <option value="3">Information Systems</option>
                    </select></label>
                </fieldset>

                <fieldset>
                <legend>Available Courses</legend>
                    <table>
                        <tr>
                            <th>+</th>
                            <th>Course Name</th>
                            <th>Course Description</th>
                            <th>Course Level</th>
                            <th>Course Units</th>
                        </tr>
                        <!-- Update this section to use new tables -->
                <?php   while($row=$result->fetch_assoc()) {            ?>
                        <tr>
                            <td><input name="Courses[]" type="checkbox" value="<?php echo $row["CRS_ID"]?>"></td>
                            <td><?php echo $row["CRS_NAME"];?></td>
                            <td><?php echo $row["CRS_DESC"];?></td>
                            <td><?php echo $row["CRS_LEVEL"];?></td>
                            <td><?php echo $row["CRS_UNIT"];?></td>
                        </tr>        
                <?php   }                                               ?>
                        
                    </table>
                </fieldset>
                <input type="submit" value="Proceed &#8594" class="btn">
            </form>
        </div>
    </body>
</html>
