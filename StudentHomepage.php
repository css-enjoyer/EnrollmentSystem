<?php
    $conn = new mysqli("localhost:3310", "root", "0413", "school");
    if($conn -> connect_error) {
        die ("Connect Error (".$conn->connect_Errorno.") ".$conn->connect_error);
    }
    $STU_ID = substr($_REQUEST["userName"], 4);
    $ENRL_YEAR = substr($_REQUEST["userName"], 0, 4);
    $sql = "SELECT * FROM school.course";
    $result = $conn -> query($sql);
    

    // $ENRL_YEAR = date("Y");
    // $STU_ACCT_PASSWORD = $_REQUEST["PASSWORD"];
    // $add_stu_acct_query = "INSERT INTO student_account(ENRL_YEAR, STU_ACCT_PASSWORD) VALUES ($ENRL_YEAR, '$STU_ACCT_PASSWORD');";
    // mysqli_query($conn, $add_stu_acct_query);
    // $STU_ID = $conn->insert_id;

    // $STU_EMAIL = $_REQUEST["EMAIL"];
    // $STU_FNAME = $_REQUEST["FNAME"];
    // $STU_MI = $_REQUEST["MI"];
    // $STU_LNAME = $_REQUEST["LNAME"];
    // $STU_GENDER = $_REQUEST["GENDER"];
    // $STU_BDAY = $_REQUEST["BDAY"];
    // $DEPT_ID = $_REQUEST["DEPT_ID"];
    // $SPEC_ID = $_REQUEST["SPEC_ID"];

    // $add_stu_query = "INSERT INTO student(STU_ID, ENRL_YEAR, STU_FNAME, STU_MI, STU_LNAME, STU_BDAY, STU_GENDER, DEPT_ID, SPEC_ID, STU_EMAIL)
	// VALUES ($STU_ID, $ENRL_YEAR, '$STU_FNAME', '$STU_MI', '$STU_LNAME', '$STU_BDAY', '$STU_GENDER', $DEPT_ID, $SPEC_ID, '$STU_EMAIL');";
    // mysqli_query($conn, $add_stu_query);

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
        console.log("========== LOG ==========")
        console.log(<?php echo $ENRL_YEAR . " " . $STU_ID ?>);
    function openInfoForm() {
        document.getElementById("updateinfoform").style.display = "flex";
    }
    function closeInfoForm() {
        document.getElementById("updateinfoform").style.display = "none";
    }
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
            <h1><?= $STU_FNAME ?>'s Profile</h1>
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
                        <th>Actions</th>
                    </tr>
                    <!-- Update this section to print student information from table with php -->
                    <tr>
                        <td><?= $ENRL_YEAR . $STU_ID ?></td>
                        <td><?= $STU_FNAME . $STU_FNAME ?></td>
                        <td><?= $STU_EMAIL ?></td>
                        <td><?= $DEPT_ID ?></td>
                        <td><?= $SPEC_ID ?></td>
                        <td><?= $STU_BDAY ?></td>
                        <td><?= $STU_GENDER ?></td>
                        <td>
                            <button onclick="openInfoForm()" class="updateinfo-btn">Update</button>
                        </td>
                    <!--  -->
                    </tr>        
                </table>
            </fieldset>

            <fieldset>
            <legend>Enrolled Courses</legend>
                <table>
                    <tr>
                        <th>Course ID</th>
                        <th>Course Name</th>
                        <th>Course Description</th>
                        <th>Course Level</th>
                        <th>Course Units</th>
                        <th>Actions</th>
                    </tr>
                    <!-- Update button to delete course from student courses -->
                    <!-- Update this section to print enrolled courses with php -->
                    <tr>
                        <th>1</th>
                        <th>ICS2602</th>
                        <th>Computer Programming 1</th>
                        <th>1</th>
                        <th>5</th>
                        <th><button action="" class="removecrs-btn">Drop</button></th>
                    </tr>
                    <!--  -->
                </table>
                <button onclick="openEnrollForm()" class="enrollcrs-btn">Enroll New Course +</button>
            </fieldset>

            
            <!-- Enroll Course Form Popup [Add form action to update student enrolled courses] -->
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

            <!-- Update Info Form Popup [Add form action to update student information]--> 
            <form action="" method="POST" name="myForm" id="updateinfoform">
                <fieldset>
                    <legend>Enter your personal information: </legend>
                    <label>First Name: <input type="text" name="FNAME" required></label>
                    <label>Middle Initial: <input type="text" name="MI" required></label>
                    <label>Last Name: <input type="text" name="LNAME" required></label>
                    <label>Gender: <select name="GENDER" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select></label>
                    <label>Date of Birth: <input type="date" name="BDAY" required></label>
                    <div class="formBtns">
                        <button onclick="closeInfoForm()" class="update-btn cancel">Close</button>
                        <input type="submit" value="Update" class="update-btn" formaction="">
                    </div>
                </fieldset>
            </form>

        </div>
    </body>
</html>