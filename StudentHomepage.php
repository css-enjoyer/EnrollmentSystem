<?php
$conn = new mysqli("localhost:3306", "root", "mysql123", "school");

if ($conn->connect_error) {
    die("Connect Error (" . $conn->connect_Errorno . ") " . $conn->connect_error);
}

$STU_ID = substr($_REQUEST["userName"], 4);
$ENRL_YEAR = substr($_REQUEST["userName"], 0, 4);
$sql = "SELECT * FROM course; 
-- as co
-- INNER JOIN class as cl
-- on co.CRS_ID = cl.CRS_ID
-- INNER JOIN student as s
-- on cl.STU_ID = s.STU_ID
--     WHERE s.STU_ID = $STU_ID";
$result = $conn->query($sql);

$student_info_query = "SELECT * FROM student AS s
INNER JOIN department AS d
    ON s.DEPT_ID = d.DEPT_ID
INNER JOIN specialization AS sp
    ON s.SPEC_ID = sp.SPEC_ID
        WHERE s.STU_ID = $STU_ID AND s.ENRL_YEAR = $ENRL_YEAR;";
$student_info_result = $conn->query($student_info_query);
$student_info_row = $student_info_result->fetch_assoc();

$STU_EMAIL = $student_info_row["STU_EMAIL"];
$STU_FNAME = $student_info_row["STU_FNAME"];
$STU_MI = $student_info_row["STU_MI"];
$STU_LNAME = $student_info_row["STU_LNAME"];
$STU_GENDER = $student_info_row["STU_GENDER"];
$STU_BDAY = $student_info_row["STU_BDAY"];
$DEPT_NAME = $student_info_row["DEPT_NAME"];
$SPEC_NAME = $student_info_row["SPEC_NAME"];

$info_query = "SELECT * FROM student AS s
	INNER JOIN enrollment AS e
		ON s.STU_ID = e.STU_ID AND s.ENRL_YEAR = e.ENRL_YEAR
	INNER JOIN class AS c
		ON e.CLASS_ID = c.CLASS_ID
	INNER JOIN course AS co
		ON c.CRS_ID = co.CRS_ID
	INNER JOIN instructor AS i
		ON c.INSTR_ID = i.INSTR_ID
    INNER JOIN department AS d
		ON s.DEPT_ID = d.DEPT_ID
	INNER JOIN specialization AS sp
		ON s.SPEC_ID = sp.SPEC_ID
			WHERE s.STU_ID = $STU_ID AND e.ENRL_YEAR = $ENRL_YEAR;";

$info_query_result = $conn->query($info_query);
// $info_query_row = $info_query_result->fetch_assoc();

function deleteEnrollment($ENRL_ID)
{
    $conn = new mysqli("localhost:3310", "root", "mysql", "school");

    if ($conn->connect_error) {
        die("Connect Error (" . $conn->connect_Errorno . ") " . $conn->connect_error);
    }
    mysqli_query($conn, "DELETE FROM `school`.`ENROLLMENT` WHERE (`ENRL_ID` = $ENRL_ID);");

}

$conn->close();

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
    // console.log("========== LOG ==========")
    // console.log();

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
        document.getElementById("enrollform").style.display = "hidden";
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
                    <td><?= $STU_FNAME . " " . $STU_LNAME ?></td>
                    <td><?= $STU_EMAIL ?></td>
                    <td><?= $DEPT_NAME ?></td>
                    <td><?= $SPEC_NAME ?></td>
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
                    <th>Course Name</th>
                    <th>Course Description</th>
                    <th>Course Level</th>
                    <th>Course Department</th>
                    <th>Class Section</th>
                    <th>Course Units</th>
                    <th>Class Instructor</th>
                    <th>Actions</th>
                </tr>

                <?php while ($info_query_row = $info_query_result->fetch_assoc()) {            ?>
                    <tr>
                        <td><?php echo $info_query_row["CRS_NAME"]; ?></td>
                        <td><?php echo $info_query_row["CRS_DESC"]; ?></td>
                        <td><?php echo $info_query_row["CRS_LEVEL"]; ?></td>
                        <td><?php echo $info_query_row["DEPT_NAME"]; ?></td>
                        <td><?php echo $info_query_row["CLASS_SECTION"]; ?></td>
                        <td><?php echo $info_query_row["CRS_UNIT"]; ?></td>
                        <td><?php echo $info_query_row["INSTR_FNAME"] . " " . $info_query_row["INSTR_LNAME"]; ?></td>
                        <th><button action="<?php deleteEnrollment($info_query_row["ENRL_ID"])?>" class="removecrs-btn" name="deleteCourse">Drop</button></th>
                    </tr>
                <?php   }                                               ?>
                <!--  -->
            </table>
            <button onclick="openEnrollForm()" class="enrollcrs-btn">Enroll New Course +</button>
        </fieldset>


        <!-- Enroll Course Form Popup [Add form action to update student enrolled courses] -->
        <form action="StudentFunction.php" method="POST" id="enrollform" name="enrollform">
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
                    <?php while ($row = $result->fetch_assoc()) {            ?>
                        <tr>
                            <td><input name="Courses[]" type="checkbox" value="<?php echo $row["CRS_ID"] ?>"></td>
                            <td><?php echo $row["CRS_ID"]; ?></td>
                            <td><?php echo $row["CRS_NAME"]; ?></td>
                            <td><?php echo $row["CRS_DESC"]; ?></td>
                            <td><?php echo $row["CRS_LEVEL"]; ?></td>
                            <td><?php echo $row["CRS_UNIT"]; ?></td>
                            <!-- hidden form field for the session of STU_ID and ENRL_YEAR -->
                            <input type="hidden" name="STU_ID" value="<?= $ENRL_YEAR . $STU_ID ?>">
                        </tr>
                    <?php   }                                               ?>
                </table>
                <div class="formBtns">
                    <button onclick="closeEnrollForm()" class="enrollcrs-btn cancel">Close</button>
                    <input type="submit" name="addCourse" value="Enroll +" class="enrollcrs-btn">
                </div>
            </fieldset>
        </form>

        <!-- Update Info Form Popup [Add form action to update student information]-->
        <form action="StudentFunction.php" method="POST" name="myForm" id="updateinfoform">
            <fieldset>
                <legend>Enter your personal information: </legend>

                <input type="hidden" id="stuID" name="stuID" value="<?php echo $STU_ID; ?>">
                <input type="hidden" id="enrlYear" name="enrlYear" value="<?php echo $ENRL_YEAR; ?>">
                <!-- hidden form field for the session of STU_ID and ENRL_YEAR -->
                <input type="hidden" name="STU_ID" value="<?= $ENRL_YEAR . $STU_ID ?>">

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
                    <input type="submit" name="UPDATE-STU" value="Update" class="update-btn">
                </div>
            </fieldset>
        </form>

    </div>
</body>

</html>




<?php
// if (isset($_POST['addCourse'])) {
//     $CRS_IDs = $_POST['Courses'];
//     foreach ($CRS_IDs as $CRS_ID) {
//         $add_enrollment_query = "INSERT INTO enrollment(STU_ID, ENRL_YEAR, CLASS_ID) VALUES ($STU_ID, $ENRL_YEAR, $CRS_ID + 1000)";
//         mysqli_query($conn, $add_enrollment_query);
//         // echo $add_enrollment_query . "<br><br><br>";
//     }
// }

// elseif (isset($_POST['updateStudentInfo'])) {
//     // echo "Update";
//     echo "<script> alert('Hellow World'); </script> ";

//     $origin = "SELECT * FROM student WHERE STU_ID = $STU_ID AND ENRL_YEAR = $ENRL_YEAR";
//     $result = $conn->query($sql);
//     $rows = $result->fetch_assoc();
// }
?>