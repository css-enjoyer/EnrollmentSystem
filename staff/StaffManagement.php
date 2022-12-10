<?php
require(__DIR__ . './../config.php');
// include('StaffServer.php');
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['INSTR_EMAIL'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ./../Landing.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['INSTR_EMAIL']);
    header("location: ./../Landing.php");
}
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);

if ($conn->connect_error) {
    die("Connect Error (" . $conn->connect_Errorno . ") " . $conn->connect_error);
}

$INSTR_EMAIL = $_SESSION['INSTR_EMAIL'];
$instr_info_result = mysqli_query($conn, "SELECT * FROM instructor WHERE INSTR_EMAIL ='$INSTR_EMAIL';");
$instr_info_row = mysqli_fetch_assoc($instr_info_result);
$INSTR_ID = $instr_info_row['INSTR_ID'];
$_SESSION['INSTR_ID'] = $INSTR_ID;


// QUERIES FOR DATA RETRIEVAL //


// Personal Profile (Instructor)
$instr_profile_sql = "SELECT 
                        i.INSTR_ID AS 'ID',
                        CONCAT(i.INSTR_LNAME, ', ', i.INSTR_FNAME, ' ', i.INSTR_MI) AS 'NAME',
                        i.INSTR_GENDER AS 'GENDER',
                        i.INSTR_BDAY AS 'BIRTHDATE',
                        i.INSTR_CONTACT AS 'CONTACT',
                        i.INSTR_EMAIL AS 'EMAIL',
                        i.INSTR_ADDRESS AS 'ADDRESS'
                        -- Add DEPARTMENT table (?)
                      FROM
                        instructor AS i
                      WHERE 
                        i.INSTR_ID = $INSTR_ID";

// Students handled by Instructor
$instr_handled_sql = "SELECT 
                        e.STU_ID AS 'STUDENT ID',
                        CONCAT(s.STU_LNAME, ', ', s.STU_FNAME, ' ', s.STU_MI) AS 'STUDENT NAME',
                        s.STU_EMAIL,
                        c.CRS_NAME AS 'COURSE NAME',
                        c.CRS_UNIT AS 'UNITS',
                        ENRL_ID
                      FROM enrollment AS e
                        INNER JOIN 
                            student AS s
                        ON
                            e.STU_ID = s.STU_ID
                        INNER JOIN
                            course AS c
                        ON 
                            e.CRS_ID = c.CRS_ID
                      WHERE
                        INSTR_ID = $INSTR_ID";

// Students no handled by Instructor
$instr_not_handled_sql = "SELECT DISTINCT
s.STU_ID,
CONCAT(s.STU_FNAME, ', ', s.STU_FNAME, ' ', s.STU_MI) AS 'STUDENT NAME',
s.STU_GENDER,
s.STU_BDAY,
s.STU_CONTACT,
s.STU_EMAIL,
s.STU_ADDRESS
FROM student AS s
INNER JOIN 
    enrollment AS e
ON
    s.STU_ID = e.STU_ID
INNER JOIN
    course AS c
ON 
    e.CRS_ID = c.CRS_ID
WHERE 
s.STU_ID NOT IN (SELECT s.STU_ID
FROM student AS s
INNER JOIN 
    enrollment AS e
ON
    s.STU_ID = e.STU_ID
INNER JOIN
    course AS c
ON 
    e.CRS_ID = c.CRS_ID
WHERE 
-- REPLACE WITH $INSTR_ID.
INSTR_ID = $INSTR_ID);";


// ROW INIT //
$instr_profile_result = $conn->query($instr_profile_sql);
$instr_profile_row = $instr_profile_result->fetch_assoc();

$instr_handled_result = $conn->query($instr_handled_sql);
// nagiging kulang to pag kinuha mo kagad dito!
// $instr_handled_row = $instr_handled_result->fetch_assoc();

$instr_not_handled_result = $conn->query($instr_not_handled_sql);
// $instr_not_handled_row = $instr_not_handled_result->fetch_assoc();


// INIT STUDENT DETAILS //
$INSTR_ID = $instr_profile_row['ID'];
$INSTR_NAME = $instr_profile_row['NAME'];
$INSTR_GENDER = $instr_profile_row['GENDER'];
$INSTR_BDAY = $instr_profile_row['BIRTHDATE'];
$INSTR_CONTACT = $instr_profile_row['CONTACT'];
$INSTR_EMAIL = $instr_profile_row['EMAIL'];
$INSTR_ADDRESS = $instr_profile_row['ADDRESS'];

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./../styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;800&display=swap" rel="stylesheet">
</head>
<script>
    function openInfoForm() {
        // event.preventDefault();
        document.getElementById("updateinfoform").style.display = "flex";
    }

    function closeInfoForm() {
        // event.preventDefault();
        document.getElementById("updateinfoform").style.display = "none";
    }

    function openEnrollStudentToCourseForm() {
        event.preventDefault();
        // bruh same ung name lmao
        document.getElementById("enrollform").style.display = "flex";
    }

    function closeEnrollStudentToCourseForm() {
        // prevents button from sending a postback that resets the page, idk ung update stu info di kailangan ng ganito?! related sa server handling...
        event.preventDefault();
        document.getElementById("enrollform").style.display = "none";
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
            <li><a href="StaffManagement.php?logout=1">Logout</a></li>
        </ul>
    </div>
    <div class="mainsection">
        <h1>System Dashboard</h1>
        <h2><?= $INSTR_NAME ?>'s Profile</h2>
        <?php if (isset($_SESSION['message'])) : ?>
            <div class="msg">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif ?>
        <fieldset>
            <legend>Instructor Info</legend>
            <table>
                <tr>
                    <th>Instructor ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Birthday</th>
                    <th>Contact No.</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>

                <!-- PRINTING INSTRUCTOR DETAILS -->
                <tr>
                    <td><?= $INSTR_ID ?></td>
                    <td><?= $INSTR_NAME ?></td>
                    <td><?= $INSTR_GENDER ?></td>
                    <td><?= $INSTR_BDAY ?></td>
                    <td><?= $INSTR_CONTACT ?></td>
                    <td><?= $INSTR_EMAIL ?></td>
                    <td><?= $INSTR_ADDRESS ?></td>
                    <td>
                        <button onclick="openInfoForm()" class="updateinfo-btn">Update</button>
                    </td>
                </tr>

            </table>
        </fieldset>

        <!-- STUDENTS HANDLED BY INSTRUCTOR -->
        <form action="StaffServer.php" method="POST" name="stu-of-instr">
            <fieldset>
                <legend>Students Handled</legend>
                <table>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Student Email</th>
                        <th>Course Name</th>
                        <th>Units</th>
                        <th>Actions</th>
                    </tr>
                    <?php while ($instr_handled_row = $instr_handled_result->fetch_assoc()) {            ?>
                        <tr>
                            <td><?php echo $instr_handled_row['STUDENT ID']; ?></td>
                            <td><?php echo $instr_handled_row['STUDENT NAME']; ?></td>
                            <td><?php echo $instr_handled_row['STU_EMAIL']; ?></td>
                            <td><?php echo $instr_handled_row['COURSE NAME']; ?></td>
                            <td><?php echo $instr_handled_row['UNITS']; ?></td>

                            <!-- TODO: BUTTON NOT FUNCTIONAL -->
                            <!-- TODO: BUTTON RESTRICTS STUDENTS DISPLAYED -->
                            <th><button class="removecrs-btn" name="drop-handled-stu" value="<?php echo $instr_handled_row["ENRL_ID"] ?>">Drop Student</button></th>
                        </tr>
                    <?php   }                                               ?>
                </table>
                <button onclick="openEnrollStudentToCourseForm();" class="enrollcrs-btn">Enroll New Student +</button>
            </fieldset>
        </form>

    </div>

    <!-- same ung name dead dbale na sa ibang server nmn to mapupunta -->
    <!-- Enroll Student to Course Form Popup -->
    <form action="StaffServer.php" method="POST" id="enrollform" name="enrollstudenttocourseform">
        <fieldset>
            <legend>Students not yet enrolled to your class</legend>
            <table>
                <tr>
                    <th>+</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Gender</th>
                    <th>Birthday</th>
                    <th>Contact No.</th>
                    <th>Student Email</th>
                    <th>Address</th>
                </tr>

                <?php while ($instr_not_handled_row = $instr_not_handled_result->fetch_assoc()) {            ?>
                    <tr>
                        <td><input name="Students[]" type="checkbox" value="<?php echo $instr_not_handled_row["STU_ID"] ?>"></td>
                        <td><?php echo $instr_not_handled_row["STU_ID"]; ?></td>
                        <td><?php echo $instr_not_handled_row["STUDENT NAME"]; ?></td>
                        <td><?php echo $instr_not_handled_row["STU_GENDER"]; ?></td>
                        <td><?php echo $instr_not_handled_row["STU_BDAY"]; ?></td>
                        <td><?php echo $instr_not_handled_row["STU_CONTACT"]; ?></td>
                        <td><?php echo $instr_not_handled_row["STU_EMAIL"]; ?></td>
                        <td><?php echo $instr_not_handled_row["STU_ADDRESS"]; ?></td>
                    </tr>
                <?php   }                                               ?>
            </table>
            <div class="formBtns">
                <button onclick="closeEnrollStudentToCourseForm()" class="enrollcrs-btn cancel">Close</button>
                <input type="submit" name="add-stu-to-instr-course" value="Enroll Student +" class="enrollcrs-btn">
            </div>
        </fieldset>
    </form>

    <!-- Update Info Form Popup -->
    <form action="StaffServer.php" method="POST" name="myForm" id="updateinfoform">
        <fieldset>
            <legend>Enter your personal information: </legend>
            <label>Address: <input type="text" name="UPDATE_INSTR_ADDRESS" required></label>
            <label>Contact Number: <input type="text" name="UPDATE_INSTR_CONTACT" required maxlength="11"></label>
            <!-- SUBMIT && CLOSE -->
            <div class="formBtns">
                <button onclick="closeInfoForm()" class="update-btn cancel">Close</button>
                <input type="submit" name="update-instr-info" value="Update" class="update-btn">
            </div>
        </fieldset>
    </form>
</body>

</html>