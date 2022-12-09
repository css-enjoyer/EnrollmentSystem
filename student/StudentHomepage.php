<?php
require('./../config.php');
include('StudentServer.php');
session_start();
if (!isset($_SESSION['STU_EMAIL'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ./../Landing.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['STU_EMAIL']);
    header("location: ./../Landing.php");
}

$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);

if ($conn->connect_error) {
    die("Connect Error (" . $conn->connect_Errorno . ") " . $conn->connect_error);
}

$STU_EMAIL = $_SESSION['STU_EMAIL'];
$stu_info_result = mysqli_query($conn, "SELECT * FROM student WHERE STU_EMAIL ='$STU_EMAIL';");
$stu_info_row = mysqli_fetch_assoc($stu_info_result);
$STU_ID = $stu_info_row['STU_ID'];


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
$crs_sql = "SELECT DISTINCT c.CRS_NAME, c.CRS_UNIT,
-- c.CRS_NAME AS 'COURSE NAME', 
-- c.CRS_UNIT AS 'UNITS', 
CONCAT(i.INSTR_LNAME, ', ', i.INSTR_FNAME, ' ', i.INSTR_MI) AS 'INSTR_NAME'
FROM course AS c
INNER JOIN 
    enrollment AS e
ON 
    c.CRS_ID = e.CRS_ID
INNER JOIN
    instructor AS i
ON c.INSTR_ID = i.INSTR_ID
INNER JOIN
    student AS s
ON e.STU_ID = s.STU_ID
WHERE 
c.CRS_ID NOT IN (SELECT c.CRS_ID FROM course AS c 
INNER JOIN enrollment AS e 
ON c.CRS_ID = e.CRS_ID 
INNER JOIN student AS s 
ON e.STU_ID = s.STU_ID
WHERE s.STU_ID = $STU_ID);";


// ROW INIT //
$stu_profile_result = $conn->query($stu_profile_sql);
$stu_profile_row = $stu_profile_result->fetch_assoc();

$stu_enrolled_result = $conn->query($stu_enrolled_sql);
// $stu_enrolled_row = $stu_enrolled_result->fetch_assoc();

$crs_sql_result = $conn->query($crs_sql);
// $crs_sql_row = $crs_sql_result->fetch_assoc();


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
            <li><a href="StudentHomepage.php?logout=1">Logout</a></li>
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
        <form action="" method="POST" id="enrollform" name="enrollform">
            <fieldset>
                <legend>Available Courses</legend>
                <table>
                    <tr>
                        <th>+</th>
                        <th>Course Name</th>
                        <th>Course Units</th>
                        <th>Instructor</th>
                    </tr>
                    <!-- UPDATE: ONLY VIEW NON-DUPLICATE COURSES -->
                    <!-- UPDATE: RESPECTIVE VARIABLES FOR ROW, RESULT, ETC. -->
                    <?php while ($crs_sql_row = $crs_sql_result->fetch_assoc()) {            ?>
                        <tr>
                            <td><input name="Courses[]" type="checkbox" value="<?php echo $row["CRS_ID"] ?>"></td>
                            <td><?php echo $crs_sql_row["CRS_NAME"]; ?></td>
                            <td><?php echo $crs_sql_row["CRS_UNIT"]; ?></td>
                            <td><?php echo $crs_sql_row["INSTR_NAME"]; ?></td>
                            <!-- ADD INSTRUCTOR (?) -->

                            <!-- SESSION: Student ID -->
                            <!-- <input type="hidden" name="STU_ID" value="<?= $STU_ID ?>"> -->
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