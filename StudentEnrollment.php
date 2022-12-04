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
                <img src="images/ustseal.png" width="50px">
            </div>
            <ul>
                <li>Notifications</li>
                <li>Messages</li>
                <li><a href="Landing.html">Logout</a></li>
            </ul>
        </div>
        <div class="mainsection">
            <h1>Student Information</h1>
            <form action="Enroll.php" method="POST">
                <fieldset>
                    <table>
                        <tr>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Specialization</th>
                            <th>Birthday</th>
                            <th>Gender</th>
                            <th>Student Type</th>
                            <th>Actions</th>
                        </tr>
                        <!-- php to print while value of table exists -->
                        <tr></tr>
                    </table>
                </fieldset>
                <fieldset>
                <legend>Enrolled Courses</legend>
                    <table>
                        <tr>
                            <th>+</th>
                            <th>Course ID</th>
                            <th>Course Description</th>
                            <th>Course Instructor</th>
                            <th>Course Class</th>
                            <th>Course Units</th>
                        </tr>
                        <!-- Update this section to use new tables -->
                <!-- <?php   while($row=$result->fetch_assoc()) {            ?>
                        <tr>
                            <td><input name="Courses[]" type="checkbox" value="<?php $row["CRS_ID"]?>"></td>
                            <td><?php echo $row["CRS_ID"];?></td>
                            <td><?php echo $row["CRS_DESC"];?></td>
                            <td><?php echo $row["CRS_INSTR"];?></td>
                            <td><?php echo $row["CRS_CLASS"];?></td>
                            <td><?php echo $row["CRS_UNITS"];?></td>
                        </tr>        
                <?php   }                                               ?> -->
                    </table>
                    <input type="submit" value="Enroll New Course +" class="enrollcrs-btn">
                </fieldset>
                <input type="submit" value="Proceed &#8594" class="btn">
            </form>
        </div>
    </body>
</html>
