<?php
require ('./../config.php');
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
                        c.CRS_NAME AS 'COURSE NAME',
                        c.CRS_UNIT AS 'UNITS'
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


// ROW INIT //
$instr_profile_result = $conn->query($instr_profile_sql);
$instr_profile_row = $instr_profile_result->fetch_assoc();

$instr_handled_result = $conn->query($instr_handled_sql);
$instr_handled_row = $instr_handled_result->fetch_assoc();


// INIT STUDENT DETAILS //
$INSTR_ID = $instr_profile_row['ID'];
$INSTR_NAME = $instr_profile_row['NAME'];
$INSTR_GENDER = $instr_profile_row['GENDER'];
$INSTR_BDAY = $instr_profile_row['BIRTHDATE'];
$INSTR_CONTACT = $instr_profile_row['CONTACT'];
$INSTR_EMAIL = $instr_profile_row['EMAIL'];
$INSTR_ADDRESS = $instr_profile_row['ADDRESS'];


/* OLD QUERIES
$sql = "SELECT * FROM school.student";
$result = $conn->query($sql);

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
			WHERE i.INSTR_ID = $INSTR_ID AND i.EMPL_YEAR = $EMPL_YEAR;";

$info_query_result = $conn->query($info_query);
$info_query_row = $info_query_result->fetch_assoc();

$INSTR_EMAIL = $info_query_row["INSTR_EMAIL"];
$INSTR_FNAME = $info_query_row["INSTR_FNAME"];
$INSTR_MI = $info_query_row["INSTR_MI"];
$INSTR_LNAME = $info_query_row["INSTR_LNAME"];
$INSTR_GENDER = $info_query_row["INSTR_GENDER"];
$INSTR_BDAY = $info_query_row["INSTR_BDAY"];
$DEPT_NAME = $info_query_row["DEPT_NAME"];
*/

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
    <div class="mainsection">
        <h1>System Dashboard</h1>
        <h1><?= $INSTR_NAME ?>'s Profile</h1>
        <fieldset>
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
                        <button onclick="" class="updateinfo-btn">Update</button>
                    </td>
                </tr>

            </table>
        </fieldset>

        <!-- STUDENTS HANDLED BY INSTRUCTOR -->
        <fieldset>
            <legend>Students Handled</legend>
            <table>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Course Name</th>
                    <th>Units</th>
                    <!--<th>Actions</th>-->
                </tr>
                <!-- CONVERT INTO FORM FOR ENROLLMENT ID SIMILAR TO ENROLLMENT POPUP (?) -->
                <?php while ($instr_handled_row = $instr_handled_result->fetch_assoc()) {            ?>
                    <tr>
                        <td><?php echo $instr_handled_row['STUDENT ID']; ?></td>
                        <td><?php echo $instr_handled_row['STUDENT NAME']; ?></td>
                        <td><?php echo $instr_handled_row['COURSE NAME']; ?></td>
                        <td><?php echo $instr_handled_row['UNITS']; ?></td>

                        <!-- TODO: BUTTON NOT FUNCTIONAL -->
                        <!-- TODO: BUTTON RESTRICTS STUDENTS DISPLAYED -->
                        <!--<th><button action="" class="removecrs-btn" name="">Drop</button></th>-->
                    </tr>
                <?php   }                                               ?>
            </table>
        </fieldset>

    </div>
</body>

</html>