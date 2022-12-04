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
    <script>
    // function openForm() {
    //     document.getElementById("updateinfoform").style.display = "flex";
    // }
    // function closeForm() {
    //     document.getElementById("updateinfoform").style.display = "none";
    // }
    function openEnrollForm() {
        document.getElementById("enrollform").style.display = "flex";
    }
    function closeEnrollForm() {
        document.getElementById("enrollform").style.display = "none";
    }
    </script>
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
            <h1>[Student Name]'s Profile</h1>
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
                    <!-- Update this section to print enrolled courses -->
            
                </table>
                <button onclick="openEnrollForm()" class="enrollcrs-btn">Enroll New Course +</button>
            </fieldset>

            <!-- Enroll Course Form Popup -->
            <form action="" method="POST" id="enrollform">
                <fieldset>
                <legend>Available Courses</legend>
                    <table>
                    <tr>
                        <th>+</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Level</th>
                        <th>Units</th>
                    </tr>
            <?php   while($row=$result->fetch_assoc()) {            ?>
                    <tr>
                        <td><input name="Courses[]" type="checkbox" value="<?php $row["CRS_ID"]?>"></td>
                        <td><?php echo $row["CRS_ID"];?></td>
                        <td><?php echo $row["CRS_NAME"];?></td>
                        <td><?php echo $row["CRS_DESC"];?></td>
                        <td><?php echo $row["CRS_LEVEL"];?></td>
                        <td><?php echo $row["CRS_UNIT"];?></td>
                    </tr>        
            <?php   }                                               ?>
                    </table>
                    <div class="formBtns">
                        <button onclick="closeEnrollForm()" class="enrollcrs-btn cancel">Close</button>
                        <input type="submit" value="Enroll +" class="enrollcrs-btn" formaction="">
                    </div>
                </fieldset>
            </form>

            <!-- Update Info Form Popup -->
            <!-- <form action="" method="POST" name="myForm" id="updateinfoform">
                <h2>Choose Course</h2>
                <label>Username: <input type="text" id="userName" name="userName"/></label>
                <label>Password: <input type="password" id="passWord" name="userName"/></label>
                <div class="formBtns">
                    <button onClick="closeForm()">Cancel</button>
                    <input type="submit" onClick="return EvaluateForm();">
                </div>
            </form> -->

        </div>
    </body>
</html>
