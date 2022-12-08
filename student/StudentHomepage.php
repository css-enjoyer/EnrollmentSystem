<?php
require ('./../config.php');
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);

if ($conn->connect_error) {
    die("Connect Error (" . $conn->connect_Errorno . ") " . $conn->connect_error);
}

// RETRIEVING STU_ID
$STU_ID = $_REQUEST['userName'];

/* TO UPDATE: Check if STU_ID input is valid.
if ($STU_ID != 1000 || $STU_ID != 1001 || $STU_ID != 1002 || 
    $STU_ID != 1003 || $STU_ID != 1004) {

    echo "<script> location.href='Landing.html'; </script>";
    exit;

}
*/


// QUERIES FOR DATA RETRIEVAL //


// Personal Profile (Student)
$stu_profile_sql = "SELECT 
                        s.STU_ID AS 'ID', 
                        CONCAT(s.STU_LNAME, ', ', s.STU_FNAME, ' ', s.STU_MI) AS 'NAME',
                        s.STU_GENDER AS 'GENDER',
                        s.STU_BDAY AS 'BIRTHDAY',
                        s.STU_CONTACT AS 'CONTACT',
                        s.STU_EMAIL AS 'EMAIL',
                        s.STU_ADDRESS AS 'ADDRESS',
                        s.STU_TYPE AS 'STUDENT TYPE'
                    FROM 
                        student AS s
                    WHERE 
                        s.STU_ID = $STU_ID";

// Enrolled Courses (Student)
$stu_enrolled_sql = "SELECT 
                        c.CRS_NAME AS 'COURSE NAME', 
                        c.CRS_UNIT AS 'UNITS', 
                        CONCAT(i.INSTR_LNAME, ', ', i.INSTR_FNAME, ' ', i.INSTR_MI) AS 'INSTRUCTOR'
                    FROM enrollment AS e
                        INNER JOIN 
                            course AS c
                        ON 
                            e.CRS_ID = c.CRS_ID
                        INNER JOIN
                            instructor AS i
                        ON
                            c.INSTR_ID = i.INSTR_ID
                    WHERE 
                        STU_ID = $STU_ID";

// Available Courses
$crs_sql = "SELECT * FROM course";


// ROW INIT //
$stu_profile_result = $conn->query($stu_profile_sql);
$stu_profile_row = $stu_profile_result->fetch_assoc();

$stu_enrolled_result = $conn->query($stu_enrolled_sql);
$stu_enrolled_row = $stu_enrolled_result->fetch_assoc();

$crs_sql_result = $conn->query($crs_sql);
$crs_sql_row = $crs_sql_result->fetch_assoc();


// INIT STUDENT DETAILS //
$STU_ID = $stu_profile_row['ID'];
$STU_NAME = $stu_profile_row['NAME'];
$STU_GENDER = $stu_profile_row['GENDER'];
$STU_BDAY = $stu_profile_row['BIRTHDAY'];
$STU_CONTACT = $stu_profile_row['CONTACT'];
$STU_EMAIL = $stu_profile_row['EMAIL'];
$STU_ADDRESS = $stu_profile_row['ADDRESS'];
// UPDATE: CHECK SUM() FOR REGULAR/IRREGULAR
$STU_TYPE = $stu_profile_row['STUDENT TYPE'];


// CLOSING CONNECTION //
$conn->close();

/* OLD QUERIES
$STU_ID = substr($_REQUEST["userName"], 4);
$ENRL_YEAR = substr($_REQUEST["userName"], 0, 4);
$sql = "SELECT * FROM course";
$result = $conn->query($sql);

$student_info_query = "SELECT * FROM student AS s
INNER JOIN department AS d
    ON s.DEPT_ID = d.DEPT_ID
INNER JOIN specialization AS sp
    ON s.SPEC_ID = sp.SPEC_ID
        WHERE s.STU_ID = $STU_ID AND s.ENRL_YEAR = $ENRL_YEAR";
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
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment</title>
    <link rel="stylesheet" href="./../styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;800&display=swap" rel="stylesheet">
</head>
<script>
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
            <img src="./../images/ustseal.png" width="50px">
        </div>
        <ul>
            <li>Notifications</li>
            <li>Messages</li>
            <li><a href="./../Landing.php">Logout</a></li>
        </ul>
    </div>

    <!-- DISPLAYING STUDENT'S INFORMATION -->
    <div class="mainsection">
        <h1><?= $STU_NAME ?>'s Profile</h1>
        <fieldset>
            <table>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Birthday</th>
                    <th>Contact No.</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Student Type</th>
                    <th>Actions</th>
                </tr>
                <tr>
                    <td><?= $STU_ID ?></td>
                    <td><?= $STU_NAME ?></td>
                    <td><?= $STU_GENDER ?></td>
                    <td><?= $STU_BDAY ?></td>
                    <td><?= $STU_CONTACT ?></td>
                    <td><?= $STU_EMAIL ?></td>
                    <td><?= $STU_ADDRESS ?></td>
                    <td><?= $STU_TYPE ?></td>
                    <td>
                        <!-- UPDATE: BUTTON NOT FUNCTIONAL -->
                        <button onclick="openInfoForm()" class="updateinfo-btn">Update</button>
                    </td>
                </tr>
            </table>
        </fieldset>

        <!-- DISPLAYING STUDENT'S ENROLLMENT DETAILS -->
        <fieldset>
            <legend>Enrolled Courses</legend>
            <table>
                <tr>
                    <th>Course Name</th>
                    <th>Course Units</th>
                    <th>Instructor</th>
                    <th>Actions</th>
                </tr>
                <!-- CONVERT INTO FORM FOR ENROLLMENT ID SIMILAR TO ENROLLMENT POPUP (?) -->
                <?php while ($stu_enrolled_row = $stu_enrolled_result->fetch_assoc()) {            ?>
                    <tr>
                        <td><?php echo $stu_enrolled_row['COURSE NAME']; ?></td>
                        <td><?php echo $stu_enrolled_row['UNITS']; ?></td>
                        <td><?php echo $stu_enrolled_row['INSTRUCTOR']; ?></td>

                        <!-- UPDATE: BUTTON NOT FUNCTIONAL -->
                        <!-- UPDATE: DELETE ACC. TO ENROLLMENT ID -->
                        <th><button action="Landing.html" class="removecrs-btn" name="deleteCourse">Drop</button></th>
                    </tr>
                <?php   }                                               ?>
            </table>
            <button onclick="openEnrollForm()" class="enrollcrs-btn">Enroll New Course +</button>
        </fieldset>


        <!-- Enroll Course Form Popup -->
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
                    <!-- UPDATE: ONLY VIEW NON-DUPLICATE COURSES -->
                    <!-- UPDATE: RESPECTIVE VARIABLES FOR ROW, RESULT, ETC. -->
                    <?php while ($row = $result->fetch_assoc()) {            ?>
                        <tr>
                            <td><input name="Courses[]" type="checkbox" value="<?php echo $row["CRS_ID"] ?>"></td>
                            <td><?php echo $row["CRS_ID"]; ?></td>
                            <td><?php echo $row["CRS_NAME"]; ?></td>
                            <td><?php echo $row["CRS_UNIT"]; ?></td>
                            <!-- ADD INSTRUCTOR (?) -->

                            <!-- SESSION: Student ID -->
                            <input type="hidden" name="STU_ID" value="<?= $STU_ID ?>">
                        </tr>
                    <?php   }                                               ?>
                </table>
                <div class="formBtns">
                    <button onclick="closeEnrollForm()" class="enrollcrs-btn cancel">Close</button>
                    <input type="submit" name="addCourse" value="Enroll +" class="enrollcrs-btn">
                </div>
            </fieldset>
        </form>

        <!-- Update Info Form Popup -->
        <form action="StudentFunction.php" method="POST" name="myForm" id="updateinfoform">
            <fieldset>
                <legend>Enter your personal information: </legend>

                <!-- SESSION: Student ID -->
                <input type="hidden" id="stuID" name="stuID" value="<?= $STU_ID ?>">

                <label>Address: <input type="text" name="FNAME" required></label>
                <label>Contact Number: <input type="text" name="MI" required></label>
                <label>Personal Email: <input type="text" name="LNAME" required></label>

                <!-- SUBMIT && CLOSE -->
                <div class="formBtns">
                    <button onclick="closeInfoForm()" class="update-btn cancel">Close</button>
                    <input type="submit" name="UPDATE-STU" value="Update" class="update-btn">
                </div>
            </fieldset>
        </form>

    </div>
</body>

</html>