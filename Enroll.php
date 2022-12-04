<?php
$conn = new mysqli("localhost:3310", "root", "0413", "school");
if($conn -> connect_error) {
    die ("Connect Error (".$conn->connect_Errorno.") ".$conn->connect_error);
}
$sql = "SELECT * FROM school.course";
$result = $conn -> query($sql);

// ID Automatically Generated in SQL 
$STU_FNAME = $_REQUEST["FNAME"];
$STU_MI = $_REQUEST["MI"];
$STU_LNAME = $_REQUEST["LNAME"];
$STU_GENDER = $_REQUEST['GENDER'];
$STU_BDAY = $_REQUEST['BDAY'];
$DEPT_ID = $_REQUEST['DEPT_ID'];
$CRS_IDs = $_POST['Courses'];

// TO FIX: Hardcoded values
$STU_ID = 106;
$ENRL_YEAR = 2022;

$CLASS_SEC = "A"; // kailangan ata makuha specialization
$CLASS_LOCATION = "Laboratory"; // ito specific lng for prog and info man.

$INSTR_ID = 500; // ito kapag 2 or more prof per course ex. prog maam. sideno at maam. alberto. rand func nlng
$EMPL_YEAR = 2010;

$add_student_query = "INSERT INTO student(ENRL_YEAR, STU_FNAME, STU_MI, STU_LNAME, STU_BDAY, STU_GENDER, DEPT_ID)
VALUES ($ENRL_YEAR, '$STU_FNAME', '$STU_MI', '$STU_LNAME', '$STU_BDAY', '$STU_GENDER', $DEPT_ID)";



if (mysqli_query($conn, $sql) ) {
    echo "Data fetched successfully";
    mysqli_query($conn, $add_student_query);
    // echo $add_student_query . "<br> <hr>";
    foreach ($CRS_IDs as $CRS_ID) {
        $add_enrollment_query = "INSERT INTO enrollment(STU_ID, ENRL_YEAR, CRS_ID) VALUES ($STU_ID, $ENRL_YEAR, $CRS_ID)";
        $add_class_query = "INSERT INTO class(STU_ID, ENRL_YEAR, CLASS_SEC, CLASS_LOC, CRS_ID, INSTR_ID, EMPL_YEAR) VALUES ($STU_ID, $ENRL_YEAR, '$CLASS_SEC', '$CLASS_LOCATION', $CRS_ID, $INSTR_ID, $EMPL_YEAR)";
        mysqli_query($conn, $add_enrollment_query);
        mysqli_query($conn, $add_class_query);
        // echo $add_enrollment_query . "<br><br><br>" . $add_class_query . "<br><hr>";
    }
} 
else {
    echo "Data fetch failed";
}

$enrollement_info_query = "SELECT CRS_LEVEL ,d.DEPT_NAME ,CLASS_SEC, CLASS_LOC, CRS_NAME, CRS_DESC, CRS_UNIT, INSTR_FNAME
FROM student AS s
	INNER JOIN enrollment AS e
		ON s.STU_ID = e.STU_ID AND s.ENRL_YEAR = e.ENRL_YEAR
	INNER JOIN course AS co
		ON e.CRS_ID = co.CRS_ID
	INNER JOIN class AS cl
		ON e.STU_ID = cl.STU_ID AND e.ENRL_YEAR = cl.ENRL_YEAR AND co.CRS_ID = cl.CRS_ID
	INNER JOIN instructor AS i
		ON cl.INSTR_ID = i.INSTR_ID AND cl.EMPL_YEAR = i.EMPL_YEAR
	INNER JOIN department AS d
		on s.DEPT_ID = d.DEPT_ID
WHERE s.STU_ID = $STU_ID;";

$enrollment_info_result = $conn -> query($enrollement_info_query);

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
            <h1>You have successfully enrolled!</h1>
            <h2><?php echo $STU_FNAME ?></h2>
            <table>
                <tr>
                    <!-- TODO CONCAT TO SECTION -->
                    <th>Course Level</th>
                    <th>Department Name</th>
                    <th>Class Section</th>
                    <th>Class Location</th>
                    <th>Course Name</th>
                    <th>Course Desc</th>
                    <th>Course Units</th>
                    <th>Instructor Name</th>
                </tr>
                
        <?php   while($row = $enrollment_info_result -> fetch_assoc()) {            ?>
                <tr>
                    <td><?php echo $row["CRS_LEVEL"];?></td>
                    <td><?php echo $row["DEPT_NAME"];?></td>
                    <td><?php echo $row["CLASS_SEC"];?></td>
                    <td><?php echo $row["CLASS_LOC"];?></td>
                    <td><?php echo $row["CRS_NAME"];?></td>
                    <td><?php echo $row["CRS_DESC"];?></td>
                    <td><?php echo $row["CRS_UNIT"];?></td>
                    <td><?php echo $row["INSTR_FNAME"];?></td>
                </tr>        
        <?php   }                                               ?>
                        
            </table>
            <a href="StudentEnrollment.php" class="btn">Return</a>
        </div>
    </body>
</html>